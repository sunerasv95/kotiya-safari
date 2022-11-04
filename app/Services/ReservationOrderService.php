<?php

namespace App\Services;

use App\Constants\Types;
use App\Models\Remark;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ReservationOrderServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservationOrderService implements ReservationOrderServiceInterface
{
    private $reservationRepository;
    private $inquiryRepository;
    private $guestRepository;
    private $adminRepository;
    private $userRepository;

    public function __construct(
        ReservationOrderRepositoryInterface $reservationRepository,
        InquiryRepositoryInterface $inquiryRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->reservationRepository    = $reservationRepository;
        $this->inquiryRepository        = $inquiryRepository;
        $this->userRepository           = $userRepository;

    }

    public function getAllReservations($status = null)
    {
        try {
            return $this->reservationRepository
                ->findAll(["inquiry", "guest"], $status)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReservationByReference(string $ReferenceNumber)
    {
        try {
            return $this->reservationRepository
                ->findOne("reservation_reference", $ReferenceNumber, ["inquiry", "guest"])
                ?->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function findReservationForGuest(string $guestEmail)
    {
        //dd($guestEmail);
        $result = [
            "error" => true,
            "message"=> null,
            "data" => []
        ];
        try {
            $guest = $this->guestRepository->findByEmail($guestEmail);
            if($guest){
                $guestCode = $guest->guest_code;
                $reservationFound = $this->reservationRepository->findReservationForGuest($guestCode);

                if(!isset($reservationFound)){
                    $result['message'] = "No reservation found!";
                }else{
                    //need to create verifcation code
                    $resRef = $reservationFound->order_reference_no;
                    $bkCode = $reservationFound->bk_verification_code;
                    $verificationCode = encrypt(rand(100000, 999999));
                    $verificationSaved = $this->reservationRepository->saveVerification(
                        $guestCode,
                        $resRef,
                        $bkCode,
                        $verificationCode
                    );
                    //dd($verificationSaved);
                    $result['error']= false;
                    $result['message']= "Email is verified successfully!";
                    $result['data']['verication_code'] = $verificationSaved['_token'];
                }
            }else {
                $result['message'] = "Invalid Email Address";
            }

            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createReservationOrder(array $data)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];

        DB::beginTransaction();

        try {

            $inquiryReference = $data['inquiry_id'];
            $inquiry = $this->inquiryRepository->findOne("inquiry_reference_no", $inquiryReference, ["guest"]);

            if($inquiry->status === Types::PENDING_STATUS){

                $currentUser        = retriveCurrentUserSession();
                $data['inquiry_id'] = $inquiry->id;
                $data['guest_id']   = $inquiry->guest_id;
                $data['reference']  = generateReferenceNumber(Types::BOOKING);
                $data['status']     = Types::PENDING_STATUS;
                $data['admin_id']   = $this->userRepository->getAdminId("admin_code", $currentUser['_adminId']);

                $this->reservationRepository->save($data);
                $this->inquiryRepository->updateStatus($inquiry, Types::RESERVED_STATUS);

                $remarkBody = isset($data['reservation_note']) ? " | ".$data['reservation_note'] : '';

                $remark                 = new Remark();
                $remark->body           = Str::of("Reservation added")->append($remarkBody);
                $remark->remarked_by    = $data['admin_id'];

                $inquiry->remarks()->save($remark);

                DB::commit();

            }else{

            }

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function updateReservationOrder(array $updateOrderData)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];

        try {
            $inquiryRef = $updateOrderData['updInquiryId'];
            $inquiry    = $this->inquiryRepository->findOne("inquiry_reference_no", $inquiryRef);

            if(!isset($inquiry)){
                $result['message'] = "Inquiry is not found!";
            }else{

            }

            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function verifyReservation(array $verificationData)
    {

    }
}
