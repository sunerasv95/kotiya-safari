<?php

namespace App\Repositories;

use App\Constants\StatusTypes;
use App\Models\Guest;
use App\Models\Inquiry;
use App\Models\VAS;
use App\Repositories\Contracts\InquiryRepositoryInterface;

const PENDING = StatusTypes::PENDING;

class InquiryRepository implements InquiryRepositoryInterface
{

    public function findAllInquiries($with=[], $status= null)
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

    public function findInquiryByReferenceNumber(string $inquiryRefNumber, $with=[])
    {
        return Inquiry::where('inquiry_reference_no', $inquiryRefNumber)
            ->when(!empty($with), function($q) use($with){
                return $q->with($with);
            })
            ->first();
    }

    public function findInquiryById(int $inquiryId)
    {
        return Inquiry::find($inquiryId);
    }

    public function save(array $newInquiry, Guest $guest)
    {
        //dd($newInquiry);
        $inquiry = new Inquiry();

        $inquiry->inquiry_reference_no   = rand(100000, 999999);
        $inquiry->guest_id               = $guest->id;
        $inquiry->checkin_date           = $newInquiry['checkin_date'];
        $inquiry->checkout_date          = $newInquiry['checkout_date'];
        $inquiry->no_adults              = $newInquiry['no_adults'];
        $inquiry->no_kids                = $newInquiry['no_kids'];
        $inquiry->ip_address             = rand(1000, 9999); //to-do: need to save real ip address
        $inquiry->status                 = PENDING;
        $inquiry->remark                 = null;
        $inquiry->created_at             = now();
        $inquiry->updated_at             = now();

        $inquiry->save();

        if(isset($newInquiry['vas_services']) && !empty($newInquiry['vas_services'])){
            $serviceIds = array_map(function($code){
                return $this->findValueAddedServiceIdByCode($code);
            }, $newInquiry['vas_services']);
            $inquiry->vass()->attach($serviceIds, ["created_at"=> now(), "updated_at" => now()]);
        }

        return $inquiry;
    }

    public function updateInquiry(Inquiry $inquiry, array $updateInquiry)
    {
        $inquiry->no_adults = $updateInquiry['updNoAdults'];
        $inquiry->no_kids   = $updateInquiry['updNoKids'];
        if(isset($updateInquiry['updRemark'])){
            $inquiry->remark = $updateInquiry['updRemark'];
        }
        return $inquiry->save();
    }

    public function updateInquiryStatus(Inquiry $inquiry, string $status=null, string $remarkText = null, array $rejectData = [])
    {
        $inquiry->status      = $status;
        $inquiry->remark      = $remarkText;

        if($status === "REJECTED"){
            $inquiry->rejected_by = $rejectData['adminId'];
            $inquiry->rejected_reason = $rejectData['rejectReason'];
            $inquiry->rejected_at = now();
        }

        return $inquiry->save();
    }

    //Value added Services
    public function findAllValueAddedServices()
    {
        return VAS::active()
        ->select([
            "service_name",
            "service_code",
            "service_description"
        ])->get();
    }

    public function findValueAddedServiceIdByCode(string $vasCode)
    {
        return VAS::active()->where("service_code", $vasCode)->select("id")->first()->id;
    }

    public function inquiryCountByStatus($status = null)
    {
        return Inquiry::where('status', $status)->where('is_deleted', 0)->get()->count();
    }

}
