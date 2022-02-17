<?php

namespace App\Services;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use App\Services\Contracts\DashboardServiceInterface;
use Throwable;

class DashboardService implements DashboardServiceInterface
{
    private $inquiryRepository;
    private $reservationRepository;

    public function __construct(
        InquiryRepositoryInterface $inquiryRepository,
        ReservationOrderRepositoryInterface $reservationRepository
    )
    {
        $this->inquiryRepository = $inquiryRepository;
        $this->reservationRepository = $reservationRepository;
    }

    public function renderDashboardCardSummary()
    {
        $response = [
            "data" => []
        ];

        $inquiryCount = $pendingBookings = $pendingPayments = $customersCount = 0;

        try {
            $inquiryCount = $this->inquiryRepository->inquiryCountByStatus("PENDING");
            $pendingBookings = $this->reservationRepository->reservationCountByStatus("PENDING");
            $pendingPayments = $this->reservationRepository->reservationCountByVerificationStatus(0);

            //dd($inquiryCount);
            $response['data']['inquiryCount']       = sprintf("%02d", $inquiryCount);
            $response['data']['pendingBookings']    = sprintf("%02d", $pendingBookings);
            $response['data']['pendingPayments']    = sprintf("%02d",  $pendingPayments);
            $response['data']['customersCount']     = sprintf("%02d", $customersCount);

            return $response;
        } catch (Throwable $th) {
            throw $th;
        }

    }
}
