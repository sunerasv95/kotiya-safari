<?php

namespace App\Services\Contracts;

interface GuestServiceInterface
{
    public function getAllGuests();

    public function getGuestByCode(string $guestCode);

    public function createGuest(array $newGuest);
}
