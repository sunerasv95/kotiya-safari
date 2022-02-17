<?php

namespace App\Repositories;

use App\Models\Inquiry as RepoModel;
use App\Models\Inquiry;
use App\Models\VAS;
use App\Repositories\Contracts\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{

    public function findAllInquiries($with=[], $status= null)
    {
        return RepoModel::when(!empty($with), function($q)use($with){
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
        return RepoModel::where('inquiry_reference_no', $inquiryRefNumber)
            ->when(!empty($with), function($q) use($with){
                return $q->with($with);
            })
            ->first();
    }

    public function findInquiryById(int $inquiryId)
    {
        return RepoModel::find($inquiryId);
    }

    public function saveInquiry(array $newInquiry)
    {
        //dd($newInquiry);
        $inquiry = new RepoModel();

        $inquiry->inquiry_reference_no   = rand(100000, 999999);
        $inquiry->guest_id               = $newInquiry['guestId'];
        $inquiry->checkin_date           = $newInquiry['checkinDate'];
        $inquiry->checkout_date          = $newInquiry['checkoutDate'];
        $inquiry->no_adults              = $newInquiry['noAdults'];
        $inquiry->no_kids                = $newInquiry['noKids'];
        $inquiry->ip_address             = rand(1000, 9999); //to-do: need to save real ip address
        $inquiry->status                 = "PENDING";
        $inquiry->remark                 = null;
        $inquiry->created_at             = now();
        $inquiry->updated_at             = now();

        $inquiry->save();

        if(isset($newInquiry['reqServices']) && !empty($newInquiry['reqServices'])){
            $serviceIds = array_map(function($code){
                return $this->findValueAddedServiceIdByCode($code);
            }, $newInquiry['reqServices']);
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

    public function updateInquiryStatus(RepoModel $inquiry, string $status=null, string $remarkText = null, array $rejectData = [])
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
        return RepoModel::where('status', $status)->where('is_deleted', 0)->get()->count();
    }

}
