<?php

namespace App\Services\Contracts;

interface ReservationOrderServiceInterface
{
    public function getAllReservations();

    public function getReservationByBkRefNumber(string $bkRefNumber);

    public function findReservationForGuest(string $guestEmail);

    public function createReservationOrder(array $orderData);

    public function updateReservationOrder(array $updateOrderData);

    public function verifyReservation(array $verificationData);
}
