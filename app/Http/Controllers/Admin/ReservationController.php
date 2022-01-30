<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ReservationServiceInterface;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    private $reservationService;

    public function __construct(ReservationServiceInterface $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function findAll()
    {
        $reservations = $this->reservationService->getAllReservations();
        return view('admin.reservation.index', compact('reservations'));
    }

    public function store()
    {
        $reservations = $this->reservationService->getAllReservations();
        return view('admin.reservation.index', compact('reservations'));
    }

    public function findByReferenceNumber($referenceNumber)
    {
        $reservation = $this->reservationService->getReservationByBkRefNumber($referenceNumber);
        if(!isset($reservation)){
            return redirect()->back()->withErrors("Reservation is not found");
        }else{
            return view('admin.inquiry.show', compact('reservation'));
        }
    }

    
}
