<?php

namespace App\Services\Contracts;

use App\Models\Admin;
use App\Models\Guest;
use App\Models\User;

interface NotificationServiceInterface
{
    // public function notifyGuestByEmail($type, Guest $guest, array $data = []);

    // public function notifyAdminByEmail($type, Admin $admin = null, array $data = []);

    public function sendInquiryPlaced(User $guest);

    public function sendNewInquiryReceived(User $admin);

}
