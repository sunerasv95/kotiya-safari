<?php

namespace App\Http\Controllers\Guest;

use App\Constants\NotificationTypes;
use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Notifications\Guest\InquiryPlaced;
use App\Services\Contracts\NotificationServiceInterface;
use Illuminate\Http\Request;

// const GUEST_INQUIRY_PLACED = NotificationTypes::GUEST_INQUIRY_PLACED;

class HomeController extends Controller
{
    private $notificationService;

    public function __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function homePage()
    {
        return view('home');
    }

    public function testnotify()
    {
        // $guest = Guest::first();
        // //dd($guest);
        // $this->notificationService->sendNotificationToGuest(GUEST_INQUIRY_PLACED, $guest);

    }
}
