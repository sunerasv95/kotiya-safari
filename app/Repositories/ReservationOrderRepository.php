<?php

namespace App\Repositories;

use App\Models\Inquiry;
use App\Models\ReservationOrder as RepoModel;
use App\Models\ReservationOrderDetail;
use App\Models\ReservationVerification;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReservationOrderRepository implements ReservationOrderRepositoryInterface
{

    public function findAllReservations($with=[])
    {
        return RepoModel::when(!empty($with), function($q) use($with){
            return $q->with($with);
        })->get();
    }

    public function findReservationByBkRefNumber(string $bkRefNumber, $with = [])
    {
        return RepoModel::where('order_reference_no', $bkRefNumber)
            ->when(!empty($with), function($q) use($with){
                return $q->with($with);
            })
            ->first();
    }

    public function findReservationByInquiryId($inquiryId)
    {
        return RepoModel::where('inquiry_id', $inquiryId)->first();
    }

    public function findReservationForGuest(string $guestCode)
    {
        return DB::table('reservation_orders as rod')
            ->join('guests as gst', "rod.guest_code", "=", "gst.guest_code")
            ->where('rod.guest_code', $guestCode)
            ->where('rod.status', "PENDING")
            ->first();
    }

    public function saveReservation(Inquiry $inquiry, array $orderData)
    {
        //dd($inquiry, $orderData);
        $reservationOrder = new RepoModel();
        $guestCode = $inquiry->guest->guest_code;

        $reservationOrder->guest_code                 = $guestCode ?? null;
        $reservationOrder->order_reference_no         = "ROD".rand(100000, 999999);
        $reservationOrder->bk_verification_code       = "VK".rand(10000, 99999);
        $reservationOrder->is_verified                = 0;
        $reservationOrder->is_rescheduled             = 0;
        $reservationOrder->verified_at                = null;
        $reservationOrder->verification_expired_at    = Carbon::now()->addDays(5);
        $reservationOrder->remark                     = $orderData['remark'];
        $reservationOrder->status                     = "PENDING";
        $reservationOrder->is_deleted                 = 0;
        $reservationOrder->created_at                 = now();
        $reservationOrder->updated_at                 = now();

        $reservationOrder->inquiry()->associate($inquiry);
        $reservationOrder->save();

        $this->saveReservationDetails($reservationOrder, $orderData);
        return 1;
    }

    public function saveReservationDetails(RepoModel $reservationOrder, array $orderDetails)
    {
        $reservationDetail = new ReservationOrderDetail();

        $reservationDetail->total_nights    = $orderDetails['nightsCount'];
        $reservationDetail->location_code   = $orderDetails['campSiteId'];
        $reservationDetail->tent_code       = $orderDetails['tentId'];
        $reservationDetail->status          = 1;
        $reservationDetail->created_at      = now();
        $reservationDetail->updated_at      = now();

        $reservationDetail->reservationOrder()->associate($reservationOrder);
        $reservationDetail->save();
    }

    public function saveVerification(string $guestCode, string $bkRefNo, string $bkCode, string $verificationCode)
    {
        $resVerication = new ReservationVerification();
        $resVerication->guest_code = $guestCode;
        $resVerication->order_reference_no = $bkRefNo;
        $resVerication->bk_verification_code = $bkCode;
        $resVerication->_token = $verificationCode;
        $resVerication->attempts = 0;
        $resVerication->status = 1;
        $resVerication->created_at = now();
        $resVerication->updated_at = now();

        $resVerication->save();

        return $resVerication->fresh()->toArray();
    }
}
