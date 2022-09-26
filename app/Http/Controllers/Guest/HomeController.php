<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Services\Contracts\NotificationServiceInterface;


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
       
    }
}
