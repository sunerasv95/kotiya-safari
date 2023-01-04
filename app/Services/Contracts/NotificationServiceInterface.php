<?php

namespace App\Services\Contracts;

use App\Models\Admin;
use App\Models\Guest;
use App\Models\Inquiry;

interface NotificationServiceInterface
{
    // public function notifyGuestByEmail($type, Guest $guest, array $data = []);

    // public function notifyAdminByEmail($type, Admin $admin = null, array $data = []);

    public function sendInquiryAcknowledgementViaEmail(Guest $guest, Inquiry $inquiry);

    public function sendNewInquiryReceived(Admin $admin);

}
