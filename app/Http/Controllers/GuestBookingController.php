<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ReservationOrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuestBookingController extends Controller
{
    private $reservationService;

    public function __construct(ReservationOrderServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        return view('booking.verify-email');
    }

    public function verifyCode()
    {
        return view('booking.verify-code');
    }

    public function summary()
    {
        return view('booking.summary');
    }

    public function checkout(string $checkoutSessId)
    {
        //dd($checkoutSessId);
        return view('booking.checkout');
    }

    public function verifyEmail(Request $request)
    {
        $validateData = $request->validate([
            "verifyEmail" => "required|email"
        ]);
        //dd($validateData);
        $guestEmail = $validateData['verifyEmail'];
        //dd($guestEmail);

        $res = $this->reservationService->findReservationForGuest($guestEmail);
        //dd($res);
        if (!$res['error']) {
            $vftoken = $res['data']['verication_code'];
            return redirect()->route('verify-reservation')->with("vftoken", $vftoken);
        } else {
            return redirect()->back()->with("errorMsg", $res['message']);
        }
    }

    public function verifyBooking(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            "bkVerificationCode" => "required",
            "vfToken"           => "required"
        ]);

        $res = $this->reservationService->verifyReservation($validatedData);
        //dd($res);
        if (!$res['error']) {
            $vftoken = $res['data']['verication_code'];
            return redirect()->route('verify-reservation')->with("vftoken", $vftoken);
        } else {
            return redirect()->back()->with("errorMsg", $res['message']);
        }

    }

    public function payAmount(Request $request)
    {
        //dd($request->all());
        $params = [
            "merchant_id" => "1219573",
            "return_url" => "http://safari-app.test/success",
            "cancel_url" => "http://safari-app.test/cancel",
            "notify_url" => "http://safari-app.test/notify",
            "first_name" => "Sunera",
            "last_name" => "Sachintha",
            "email" => "sunera@app.com",
            "phone" => "0702627226",
            "address " => "!3/A, Sunera",
            "city" => "Sri lanka",
            "order_id" => "123ABC",
            "items" => "123ABC",
            "currency" => "USD",
            "amount" => 100
        ];

        $response = Http::post("https://sandbox.payhere.lk/pay/checkout", $params);
        dd(json_encode($response->body()));
    }
}
