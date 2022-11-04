<?php

namespace App\Repositories\Contracts;

use App\Models\Inquiry;

interface ReservationOrderRepositoryInterface
{
    public function findAll($with=[], $status = null);

    public function findOne(string $attribute, string $value, $with = []);

    public function findReservationForGuest(string $guestCode);

    public function save(array $data);

    public function saveVerification(string $guestCode, string $bkRefNo, string $bkCode, string $verificationCode);

    public function reservationCountByStatus($status = null);

    //public function reservationCountByVerificationStatus($verificationStatus = 0);

}
