<?php

namespace App\Repositories\Contracts;

interface ReservationRepositoryInterface
{
    public function findAllReservations();

    public function findReservationByBkRefNumber(string $reservationRefNumber);

    public function saveReservation(array $inquiryData);
}
