<?php

namespace App\Repositories;

use App\Models\Reservation as ModelReservation;
use App\Repositories\Contracts\ReservationRepositoryInterface;
use Carbon\Carbon;

class ReservationRepository implements ReservationRepositoryInterface
{

    public function findAllReservations()
    {
        return ModelReservation::get();
    }

    public function findReservationByBkRefNumber(string $bkRefNumber)
    {
        return ModelReservation::where('bk_reference_no', $bkRefNumber)->first();
    }

    public function saveReservation(array $inquiryData)
    {
        $newInquiry = new ModelReservation();

        $newInquiry->inquiry_id             = $inquiryData['id'];
        $newInquiry->bk_reference_no        = "KBR".rand(100000, 999999);
        $newInquiry->bk_activation_code     = "VK".rand(10000, 99999);
        $newInquiry->customer_email         = $inquiryData['customer_email'];
        $newInquiry->is_activated           = 0;
        $newInquiry->is_admin_activated     = 0;
        $newInquiry->activated_by           = 0;
        $newInquiry->activated_at           = null;
        $newInquiry->activation_expired_at  = Carbon::now()->addDays(5);
        $newInquiry->bk_status              = 0;
        $newInquiry->create_at              = now();
        $newInquiry->updated_at             = now();

        return $newInquiry->save();

    }

}
