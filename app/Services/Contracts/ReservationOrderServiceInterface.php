<?php

namespace App\Services\Contracts;

interface ReservationOrderServiceInterface
{
    public function getAllReservations($status = null);

    public function getReservationByReference(string $bkRefNumber);

    public function findReservationForGuest(string $guestEmail);

    public function createReservationOrder(array $orderData);

    public function updateReservationOrder(array $updateOrderData);

    public function verifyReservation(array $verificationData);
}
