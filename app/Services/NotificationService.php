<?php

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\NotificationServiceInterface;
use App\Notifications\Admin\NewInquiryNotification;
use App\Notifications\Guest\InquiryReceivedNotification;

class NotificationService implements NotificationServiceInterface
{

    public function sendInquiryPlaced(User $guest)
    {
        try {

            $guest->notify(new InquiryReceivedNotification());

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function sendNewInquiryReceived(User $admin)
    {
        try {

            $admin->notify(new NewInquiryNotification());
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
