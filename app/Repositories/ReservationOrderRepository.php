<?php

namespace App\Repositories;

use App\Models\Inquiry;
use App\Models\ReservationOrder;
use App\Models\ReservationOrderDetail;
use App\Models\ReservationVerification;
use App\Repositories\Contracts\ReservationOrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationOrderRepository implements ReservationOrderRepositoryInterface
{

    public function findAll($with=[], $status = null)
    {
        return ReservationOrder::when(!empty($with), function($q) use($with){
            return $q->with($with);
        })
        ->when($status != null && $status != "ALL" , function($q) use($status) {
            return $q->where('status', $status);
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function findOne(string $attribute, string $value, $with = [])
    {
        return ReservationOrder::when(isset($attribute), function($q) use($attribute, $value){
            switch($attribute){
                case "reservation_reference":
                    $q->where("reservation_reference", $value);
                break;

                case "inquiry_id":
                    $q->where("inquiry_id", $value);
                break;

                default:
                    $q->where("reservation_reference", $value);
            }
            return $q;
        })
        ->when(!empty($with), function($q) use($with){
            return $q->with($with);
        })
        ?->first();
           
    }


    public function findReservationForGuest(string $guestCode)
    {
        return DB::table('reservation_orders as rod')
            ->join('guests as gst', "rod.guest_code", "=", "gst.guest_code")
            ->where('rod.guest_code', $guestCode)
            ->where('rod.status', "PENDING")
            ->first();
    }

    public function save(array $data)
    {
        $reservation = new ReservationOrder();

        $reservation->inquiry_id            = $data['inquiry_id'];
        $reservation->guest_id              = $data['guest_id'];
        $reservation->reservation_reference = $data['reference'];
        $reservation->status                = $data['status'];
        $reservation->generated_by          = $data['admin_id'];
        $reservation->is_deleted            = 0;
        $reservation->created_at            = now();
        $reservation->updated_at            = now();

        $reservation->save();
        return $reservation;
    }

    public function saveDetails(ReservationOrder $reservationOrder, array $orderDetails)
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

    public function reservationCountByStatus($status = null)
    {
        return ReservationOrder::where('status', $status)->get()->count();
    }

    // public function reservationCountByVerificationStatus($verificationStatus = 0)
    // {
    //     return RepoModel::where('is_verified', $verificationStatus)->get()->count();
    // }
}
