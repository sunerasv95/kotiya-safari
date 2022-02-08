<?php

namespace App\Services;

use App\Repositories\Contracts\GuestRepositoryInterface;
use App\Services\Contracts\GuestServiceInterface;

class GuestService implements GuestServiceInterface
{
    private $guestRepository;

    public function __construct(GuestRepositoryInterface $guestRepository)
    {
        $this->guestRepository = $guestRepository;
    }

    public function getAllGuests()
    {
        try {
            return $this->guestRepository->findAllGuests()->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getGuestByCode(string $guestCode)
    {
        try {
            return $this->guestRepository
                ->findGuestByCode($guestCode);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createGuest(array $newGuest)
    {
        try {
            $savedInquiry = $this->guestRepository->saveGuest($newGuest);
            return $savedInquiry;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
