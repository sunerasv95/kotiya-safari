<?php

namespace App\Repositories\Contracts;

use App\Models\Inquiry;

interface ReservationOrderRepositoryInterface
{
    public function findAllReservations($with=[]);

    public function findReservationByBkRefNumber(string $reservationRefNumber, $with = []);

    public function findReservationForGuest(string $guestCode);

    public function findReservationByInquiryId($inquiryId);

    public function saveReservation(Inquiry $inquiry, array $orderData);

    public function saveVerification(string $guestCode, string $bkRefNo, string $bkCode, string $verificationCode);
}
