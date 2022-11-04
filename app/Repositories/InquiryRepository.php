<?php

namespace App\Repositories;

use App\Models\Inquiry;
use App\Models\VAS;
use App\Repositories\Contracts\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{

    public function findAll($with=[], $status= null)
    {
        return Inquiry::when(!empty($with), function($q)use($with){
            return $q->with($with);
        })
        ->when($status != null && $status != "ALL" , function($q) use($status) {
            return $q->where('status', $status);
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }

    public function findOne(string $attribute, string $value, $with=[])
    {
        return Inquiry::when(isset($attribute), function($q) use($attribute, $value){
            switch($attribute){
                case "inquiry_reference_no":
                    $q->where("inquiry_reference_no", $value);
                break;

                default:
                    $q->where("inquiry_reference_no", $value);
            }
            return $q;
        })
        ->when(!empty($with), function($q) use($with){
            return $q->with($with);
        })
        ?->first();
    }

    public function save(array $newInquiry)
    {
        $inquiry = new Inquiry();

        $inquiry->inquiry_reference_no   = $newInquiry['reference_no'];
        $inquiry->request_type	         = $newInquiry['request_type'];
        $inquiry->guest_id               = $newInquiry['user_id'];
        $inquiry->checkin_date           = $newInquiry['checkin_date'];
        $inquiry->checkout_date          = $newInquiry['checkout_date'];
        $inquiry->dates_flexible         = $newInquiry['flexible_dates'];
        $inquiry->no_adults              = $newInquiry['no_adults'];
        $inquiry->no_kids                = $newInquiry['no_kids'];
        $inquiry->status                 = $newInquiry['status'];
        $inquiry->tc_agreed              = $newInquiry['tc_agreed'];
        $inquiry->created_at             = now();
        $inquiry->updated_at             = now();

        $inquiry->save();

        return $inquiry;
    }

    public function update(Inquiry $inquiry, array $updateInquiry)
    {
        return $inquiry->update($updateInquiry);
    }

    public function updateStatus(Inquiry $inquiry, string $status)
    {
        $inquiry->status = $status;
        $inquiry->save();
        return $inquiry;
    }

}
