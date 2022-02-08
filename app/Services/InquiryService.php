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
        try {
            return $this->inquiryRepository->findAllInquiries()->toArray();
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
        try {
            return $this->inquiryRepository
                ->findInquiryByReferenceNumber($inquiryRefNumber)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createInquiry(array $newInquiry)
    {
        //dd("test",$newInquiry);
        DB::beginTransaction();
        try {
            $inqData = array(
                "checkinDate" => $newInquiry['checkInDate'],
                "checkoutDate" => $newInquiry['checkInDate'],
                "noAdults" => $newInquiry['noAdults'],
                "noKids" => $newInquiry['noKids'],
                "reqServices" => $newInquiry["selectedServicesArr"]
            );
            //dd($inqData);
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
            // dd($guest);
            $inquirySaved = $this->inquiryRepository->saveInquiry($inqData);
            DB::commit();
            return $inquirySaved;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

}
