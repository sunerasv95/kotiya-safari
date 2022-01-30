<?php

namespace App\Services\Contracts;

interface ReservationServiceInterface
{
    public function getAllReservations();

    public function getReservationByBkRefNumber(string $bkRefNumber);

    public function createReservation(int $inquiryRefNum);
}
