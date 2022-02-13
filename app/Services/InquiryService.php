<?php

namespace App\Services;

use App\Repositories\Contracts\GuestRepositoryInterface;
use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Services\Contracts\InquiryServiceInterface;
use Illuminate\Support\Facades\DB;

class InquiryService implements InquiryServiceInterface
{
    private $inquiryRepository;
    private $guestRepository;

    public function __construct(
        InquiryRepositoryInterface $inquiryRepository,
        GuestRepositoryInterface $guestRepository
    )
    {
        $this->inquiryRepository = $inquiryRepository;
        $this->guestRepository = $guestRepository;
    }

    public function getAllInquiries()
    {
        $with = [];
        try {
            $with = ["guest"];
            return $this->inquiryRepository->findAllInquiries($with)->toArray();
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
        $result = [
            "error" => true,
            "message" => null
        ];

        DB::beginTransaction();
        try {
            $inqData = array(
                "checkinDate" => $newInquiry['checkInDate'],
                "checkoutDate" => $newInquiry['checkInDate'],
                "noAdults" => $newInquiry['noAdults'],
                "noKids" => $newInquiry['noKids'],
                "reqServices" => $newInquiry["selectedServicesArr"]
            );

            $inquireEmail = $newInquiry['email'];
            $guest = $this->guestRepository->findGuestByEmail($inquireEmail);

            if(isset($guest)){
                $inqData['guestId'] = $guest->id;
            }else{
                $guestData = array(
                    "fullName" => $newInquiry['firstName']. " ". $newInquiry['lastName'],
                    "email" => $inquireEmail,
                    "country" => $newInquiry['country']
                );
                $this->guestRepository->saveGuest($guestData);
                $guest = $this->guestRepository->findGuestByEmail($inquireEmail);
                $inqData['guestId'] = $guest->id;
            }

            $inquirySaved = $this->inquiryRepository->saveInquiry($inqData);
            if($inquirySaved){
                DB::commit();
                $result['error'] = false;
                $result['message'] = "";
            }

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
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
                    $result['message'] = "Inquiry is updated successfully!";
                }
            }
            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
