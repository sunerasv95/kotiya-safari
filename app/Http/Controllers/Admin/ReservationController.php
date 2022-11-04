<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CreateReservationOrderRequest;
use App\Services\Contracts\CommonServiceInterface;
use App\Services\Contracts\ReservationOrderServiceInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $reservationService;
    private $commonService;

    public function __construct(
        ReservationOrderServiceInterface $reservationService,
        CommonServiceInterface $commonService
    )
    {
        $this->reservationService = $reservationService;
        $this->commonService = $commonService;
    }

    public function findAll()
    {
        $reservations = $this->reservationService->getAllReservations();
        $status = $this->commonService->retriveReservationStatus();
        
        $data = compact('reservations', 'status');
        return view('admin.reservation.index', $data);
    }

    public function filter(Request $request, $status = null)
    {
        if($request->ajax()){
            if(isset($status)){
                $reservations = $this->reservationService->getAllReservations($status);
                return json_encode($reservations);
            }
        }
    }

    public function findOne($reference)
    {
        $reservation = $this->reservationService->getReservationByReference($reference);
        //dd($reservation);
        if(!isset($reservation)){
            return redirect()->back()->with("errorMsg", "Reservation is not found");
        }else{
            $guest = $reservation['guest'];
            $inquiry = $reservation['inquiry'];
            $country = $reservation['guest']['country'];

            unset($reservation['guest']);
            unset($reservation['inquiry']);
            $reservation = $reservation;

            $data = compact('guest', 'inquiry', 'country', 'reservation');
            return view('admin.reservation.show', $data);
        }
    }

    public function store(CreateReservationOrderRequest $request)
    {
        $validated = $request->validated();

        $result = $this->reservationService->createReservationOrder($validated);
        
        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()->back()->with("successMsg", $result['message']);
        }
    }

}
