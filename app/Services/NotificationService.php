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
            //to-do: 
            //check admin permissions who has permission to receive inquiry alerts
            //for those who has permissions, sent this notification

            //for now, sending to super admin
            $admin->notify(new NewInquiryNotification());
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
