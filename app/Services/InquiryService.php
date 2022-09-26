<?php

namespace App\Services;

use App\Constants\NotificationTypes;
use App\Repositories\Contracts\save;
use App\Repositories\Contracts\GuestRepositoryInterface;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\InquiryServiceInterface;
use App\Services\Contracts\NotificationServiceInterface;
use Illuminate\Support\Facades\DB;

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
        $with = [];
        try {
            $with = ["guest"];
            return $this->inquiryRepository->findAllInquiries($with, $status)->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAllValueAddedServices()
    {
        try {
            return $this->inquiryRepository->findAllValueAddedServices()->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getInquiryByReferenceNumber(string $inquiryRefNumber)
    {
        $with = ["guest", "reservationOrder"];
        $nightsCount = 0;
        try {
            $iniquiryDetails = $this->inquiryRepository
                ->findInquiryByReferenceNumber($inquiryRefNumber, $with)
                ->toArray();

            if(isset($iniquiryDetails['checkin_date']) && isset($iniquiryDetails['checkout_date'])){
                $nightsCount = carbonParse($iniquiryDetails['checkout_date'])
                    ->diffInDays(carbonParse($iniquiryDetails['checkin_date']));
            }
            $iniquiryDetails['total_nights'] = $nightsCount;
            //dd($iniquiryDetails);
            return $iniquiryDetails;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createInquiry(array $newInquiry)
    {

        DB::beginTransaction();

        try {
            $inqData = array(
                "checkin_date" => $newInquiry['checkInDate'],
                "checkout_date" => $newInquiry['checkInDate'],
                "no_adults" => $newInquiry['noAdults'],
                "no_kids" => $newInquiry['noKids'],
                "vas_services" => $newInquiry["selectedServicesArr"]
            );

            //check guest is already exists
            $inquireEmail = $newInquiry['email'];
            $guest = $this->guestRepository->findByEmail($inquireEmail);

            if(!isset($guest)){
                $guestData = array(
                    "full_name" => $newInquiry['firstName']. " ". $newInquiry['lastName'],
                    "email" => $inquireEmail,
                    "country" => $newInquiry['country']
                );
                $guest = $this->guestRepository->save($guestData);
            }

            $savedInquiry = $this->inquiryRepository->save($inqData, $guest);

            //send notification to the guest user
            $this->notificationService
                ->notifyGuestByEmail(NotificationTypes::GUEST_ACKNOWLEDGEMENT_EMAIL, $guest);


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return [
            "error" => false,
            "message" => "Your request has been submited successfully"
        ];

    }

    public function updateInquiry(array $updateOrderData)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];

        try {
            $inquiryRef = $updateOrderData['updInquiryId'];
            $inquiry    = $this->inquiryRepository->findInquiryByReferenceNumber($inquiryRef);

            if(!isset($inquiry)){
                $result['message'] = "Inquiry is not found!";
            }else{
                $inquiryUpdated = $this->inquiryRepository->updateInquiry($inquiry, $updateOrderData);
                if($inquiryUpdated){
                    $result['error'] = false;
                    $result['message'] = "Inquiry has been updated!";
                }
            }
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function rejectInquiry(array $rejectData)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];

        try {
            $rejectRef  = $rejectData['rejectId'];
            $inquiry    = $this->inquiryRepository->findInquiryByReferenceNumber($rejectRef);

            if(!isset($inquiry)){
                $result['message'] = "Inquiry is not found!";
            }else{
                $currentUser = retriveCurrentUserSession();
                $rejectData['adminId'] = $this->userRepository->findId("username",$currentUser['_username']);

                $inquiryRejected = $this->inquiryRepository->updateInquiryStatus($inquiry, "REJECTED", null, $rejectData);
                if($inquiryRejected){
                    $result['error'] = false;
                    $result['message'] = "Inquiry has been rejected!";
                }
            }
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
