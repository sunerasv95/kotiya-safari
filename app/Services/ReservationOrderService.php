<?php

namespace App\Services;

use App\Constants\Types;
use App\Models\Remark;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
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
    private $paymentRepository;
    private $userRepository;

    public function __construct(
        ReservationOrderRepositoryInterface $reservationRepository,
        InquiryRepositoryInterface $inquiryRepository,
        UserRepositoryInterface $userRepository,
        PaymentRepositoryInterface $paymentRepository
    )
    {
        $this->reservationRepository    = $reservationRepository;
        $this->inquiryRepository        = $inquiryRepository;
        $this->userRepository           = $userRepository;
        $this->paymentRepository        = $paymentRepository;
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

            if($inquiry->status === Types::PENDING_STATUS && $inquiry->is_deleted === 0){

                $currentUser            = retriveCurrentUserSession();
                $data['inquiry_id']     = $inquiry->id;
                $data['guest_id']       = $inquiry->guest_id;
                $data['reference']      = generateReferenceNumber(Types::BOOKING);
                $data['status']         = Types::PARTIALLY_PAID_STATUS;
                $data['admin_id']       = $this->userRepository->getAdminId("admin_code", $currentUser['_adminId']);

                $savedReservation = $this->reservationRepository->save($data);

                if(isset($data['reservation_note'])) addRemark($inquiry,  $data['reservation_note'], $data['admin_id']);

                $this->inquiryRepository->updateStatus($inquiry, Types::RESERVED_STATUS);

                // if(){

                // }

                // $pdata['guest_id']              = $inquiry->guest_id;
                // $pdata['reservation_order_id']  = $savedReservation->id;
                // $pdata['payment_reference']     = generateReferenceNumber(Types::PAYMENT);
                // $pdata['payment_category']      = $data['payment_option'];
                // $pdata['amount']                = $data['payable_amount'];
                // $pdata['tax_p']                 = 0;
                // $pdata['tax']                   = 0;
                // $pdata['discount_p']            = 0;
                // $pdata['discount']              = 0;
                // $pdata['total']                 = $data['payable_amount'];
                // $pdata['payment_method']        = 0;
                // $pdata['status']                = 0;
               
                // $this->paymentRepository->save($pdata);

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
