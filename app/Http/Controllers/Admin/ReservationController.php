<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reservation\CreateReservationOrderRequest;
use App\Services\Contracts\ReservationOrderServiceInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $reservationService;

    public function __construct(ReservationOrderServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function findAll()
    {
        $reservations = $this->reservationService->getAllReservations();
        //dd($reservations);
        return view('admin.reservation.index', compact('reservations'));
    }

    public function store(CreateReservationOrderRequest $request)
    {
        $validatedData = $request->validated();
        $result = $this->reservationService->createReservationOrder($validatedData);

        if($result['error']){
            return redirect()->back()->with("errorMsg", $result['message']);
        }else{
            return redirect()->back()->with("successMsg", $result['message']);
        }
    }

    public function findByReferenceNumber($referenceNumber)
    {
        $reservation = $this->reservationService->getReservationByBkRefNumber($referenceNumber);
        //dd($reservation);
        if(!isset($reservation)){
            return redirect()->back()->with("errorMsg", "Reservation is not found");
        }else{
            return view('admin.reservation.show', compact('reservation'));
        }
    }

}
