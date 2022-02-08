<?php

namespace App\Repositories;

use App\Models\Guest as RepoModel;
use App\Repositories\Contracts\GuestRepositoryInterface;

class GuestRepository implements GuestRepositoryInterface
{

    public function findAllGuests()
    {
        return RepoModel::get();
    }

    public function findGuestByCode(string $guestCode)
    {
        return RepoModel::where('guest_code', $guestCode)->first();
    }

    public function findGuestByEmail(string $email)
    {
        return RepoModel::where('email', $email)->first();
    }

    public function saveGuest(array $newGuest)
    {
        $guest = new RepoModel();

        $guest->guest_code          = "CUS" . rand(100000, 999999);
        $guest->full_name           = $newGuest['fullName'];
        $guest->email               = $newGuest['email'];
        $guest->is_email_verified   = 0;
        $guest->country_code        = $newGuest['country'];
        $guest->last_login_ip       = rand(10000, 99999);
        $guest->status              = 0;
        $guest->created_at          = now();
        $guest->updated_at          = now();
        $guest->email_verified_at   = null;

        return $guest->save();

    }

}
