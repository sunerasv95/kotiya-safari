<?php

namespace App\Services;

use App\Constants\NotificationTypes;
use App\Constants\Types;
use App\Constants\UserTypes;
use App\Models\Remark;
use App\Repositories\Contracts\save;
use App\Repositories\Contracts\GuestRepositoryInterface;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\InquiryServiceInterface;
use App\Services\Contracts\NotificationServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InquiryService implements InquiryServiceInterface
{
    private $inquiryRepository;
    private $userRepository;
    private $notificationService;

    public function __construct(
        InquiryRepositoryInterface $inquiryRepository,
        UserRepositoryInterface $userRepository,
        NotificationServiceInterface $notificationService
    )
    {
        $this->inquiryRepository = $inquiryRepository;
        $this->userRepository = $userRepository;
        $this->notificationService = $notificationService;
    }

    public function getAllInquiries($status = null)
    {
        try {
            return $this->inquiryRepository
                ->findAll(["guest"], $status)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function getInquiryByReferenceNumber(string $inquiryRefNumber)
    {
        try {
            return $this->inquiryRepository
                ->findOne("inquiry_reference_no", $inquiryRefNumber, ["guest", "reservation_order", 'remarks'])
                ?->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createInquiry(array $newInquiry, string $requestType)
    {
        DB::beginTransaction();

        try {
            //check guest is already exists
            $email = $newInquiry['email'];
            $guest = $this->userRepository->findGuest("email", $email);
            
            if(!isset($guest)){
                $data = array(
                    "full_name"     => $newInquiry['full_name'],
                    "email"         => $newInquiry['email'],
                    "password"      => null,
                    "country_id"    => findCountryIdByCode($newInquiry['country'])
                );
                $guest = $this->userRepository->saveGuest($data);
            }

            $newInquiryData = array(
                "reference_no"      => rand(1000000, 9999999),
                "request_type"      => $requestType,
                "user_id"           => $guest->id,
                "checkin_date"      => $newInquiry['check_in'],
                "checkout_date"     => $newInquiry['check_out'],
                "flexible_dates"    => $newInquiry['flexible_dates'],
                "no_adults"         => $newInquiry['no_adults'],
                "no_kids"           => $newInquiry['no_kids'],
                "status"            => Types::PENDING_STATUS,
                'tc_agreed'         => $newInquiry['tc_agreed'],
            );

            //save inquiry
            $savedInquiry = $this->inquiryRepository->save($newInquiryData);
            //send notification to the guest user
            $this->notificationService->sendInquiryAcknowledgementViaEmail($guest, $savedInquiry);

            DB::commit();

            return [
                "error" => false,
                "data" => [
                    "callback_url" => route('guest.acknowledgement')
                ],
                "message" => "Your request has been submited successfully"
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function updateInquiry(array $data)
    {
        $result = [
            "error" => true,
            "message" => null
        ];

        DB::beginTransaction();

        try {

            $inquiryReference = $data['inquiry_id'];
            $inquiry = $this->inquiryRepository->findOne("inquiry_reference_no", $inquiryReference);

            if(!isset($inquiry)){
                $result['message'] = "Inquiry is not found!";
            }else{
                $updateData = [];

                if(isset($data['up_checkin'])) $updateData['checkin_date']   = $data['up_checkin'];
                if(isset($data['up_checkout'])) $updateData['checkout_date'] = $data['up_checkout'];
                if(isset($data['up_no_adults'])) $updateData['no_adults']    = $data['up_no_adults'];
                if(isset($data['up_no_kids'])) $updateData['no_kids']        = $data['up_no_kids'];

                $inquiryUpdated = $this->inquiryRepository->update($inquiry, $updateData);

                $currentUser = retriveCurrentUserSession();
                $data['admin_id'] = $this->userRepository->getAdminId("admin_code", $currentUser['_adminId']);

                $remark = new Remark();
                $remark->body = "Inquiry updated. Summary: CIN: ".$data['up_checkin'].", COUT: ".$data['up_checkout'].", PACKS: A(".$data['up_no_adults']."), K(".$data['up_no_kids'].")";
                $remark->remarked_by = $data['admin_id'];

                $inquiry->remarks()->save($remark);
                
                DB::commit();

                if($inquiryUpdated){
                    $result['error'] = false;
                    $result['message'] = "Inquiry has been updated!";
                }
            }

            return $result;

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function rejectInquiry(array $data)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];

        DB::beginTransaction();
        try {

            $inquiryReference  = $data['inquiry_id'];
            $inquiry = $this->inquiryRepository->findOne("inquiry_reference_no", $inquiryReference);

            if(!isset($inquiry)){
                $result['message'] = "Inquiry is not found!";
            }else{
                
                $currentUser = retriveCurrentUserSession();
                $data['admin_id'] = $this->userRepository->getAdminId("admin_code", $currentUser['_adminId']);

                $rejectedInquiry = $this->inquiryRepository->updateStatus($inquiry, Types::REJECTED_STATUS);

                if(isset($data['msg_body'])){
                    $remark = new Remark();
                    $remark->body = $data['msg_body'];
                    $remark->remarked_by = $data['admin_id'];

                    $rejectedInquiry->remarks()->save($remark);
                }
                
                DB::commit();
                
                $result['error'] = false;
                $result['message'] = "Inquiry has been rejected!";
            }

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
