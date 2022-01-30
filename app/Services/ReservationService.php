<?php

namespace App\Services;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use App\Services\Contracts\ReservationServiceInterface;

class ReservationService implements ReservationServiceInterface
{
    private $reservationRepository;
    private $inquiryRepository;

    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        InquiryRepositoryInterface $inquiryRepository
    )
    {
        $this->reservationRepository    = $reservationRepository;
        $this->inquiryRepository        = $inquiryRepository;
    }

    public function getAllReservations()
    {
        try {
            return $this->reservationRepository->findAllReservations()->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReservationByBkRefNumber(string $bkRefNumber)
    {
        try {
            return $this->reservationRepository
                ->findReservationByBkRefNumber($bkRefNumber)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createReservation(int $inquiryRefNum)
    {
        try {
            $inquiry = $this->inquiryRepository->findInquiryByReferenceNumber($inquiryRefNum);
            $inqData = array(
                'id' => $inquiry['inquiry_id'],
                'customer_email' => $inquiry['customer_email']
            );

            $savedInquiry = $this->reservationRepository->saveReservation($inqData);
            return $savedInquiry;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
