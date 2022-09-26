<?php

namespace App\Services;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\ReservationOrderServiceInterface;
use Illuminate\Support\Facades\DB;

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

    public function getAllReservations()
    {
        $with = ["inquiry", "inquiry.guest"];
        try {
            return $this->reservationRepository->findAllReservations($with)->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReservationByBkRefNumber(string $bkRefNumber)
    {
        $with = ["inquiry", "inquiry.guest", "reservationOrderDetails"];
        try {
            return $this->reservationRepository
                ->findReservationByBkRefNumber($bkRefNumber, $with)
                ->toArray();
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

    public function createReservationOrder(array $orderData)
    {
        $result = [
            "error" => true,
            "message"=> null
        ];
        DB::beginTransaction();
        try {
            $inquiryRef = $orderData['inquiryId'];
            $inquiry    = $this->inquiryRepository->findInquiryByReferenceNumber($inquiryRef, ["guest"]);
            //dd($orderData);
            if(isset($inquiry)){
                $inquiryId = $inquiry->id;
                $reservationOrder = $this->reservationRepository->findReservationByInquiryId($inquiryId);
                if(isset($reservationOrder)){
                    $result['message'] = "A Reservation has already created for this inquiry!";
                }else{
                    if($inquiry['is_deleted'] == 1){
                        $result['message'] = "Inquiry is not exists!";
                    }elseif($inquiry['status'] == 2){
                        $result['message'] = "Inquiry is already processed!";
                    }else{
                        $currentUser = retriveCurrentUserSession();
                        //dd($currentUser);
                        $orderData['adminId'] = $this->userRepository->findId("username", $currentUser['_username']);
                        $orderSaved = $this->reservationRepository->saveReservation($inquiry, $orderData);
                        $inquiryStatusUpdated = $this->inquiryRepository->updateInquiryStatus($inquiry, "RESERVATIONS");

                        if($orderSaved && $inquiryStatusUpdated){
                            DB::commit();
                            $result['error']    = false;
                            $result['message']  = "Reservation has been created!";
                        }
                    }
                }
            }else{
                $result['message'] = "Inquiry is not found!";
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
            $inquiry    = $this->inquiryRepository->findInquiryByReferenceNumber($inquiryRef);

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
