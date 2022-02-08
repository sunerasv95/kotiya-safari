<?php

namespace App\Repositories\Contracts;

interface GuestRepositoryInterface
{
    public function findAllGuests();

    public function findGuestByCode(string $guestCode);

    public function findGuestByEmail(string $email);

    public function saveGuest(array $newGuest);
}
