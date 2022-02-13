<?php

namespace App\Repositories;

use App\Models\Inquiry as RepoModel;
use App\Models\Inquiry;
use App\Models\VAS;
use App\Repositories\Contracts\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{

    public function findAllInquiries($with=[])
    {
        return RepoModel::when(!empty($with), function($q)use($with){
            return $q->with($with);
        })->get();
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

        $inquiry->inquiry_reference_no   = "KSQ" . rand(100000, 999999);
        $inquiry->guest_id               = $newInquiry['guestId'];
        $inquiry->checkin_date           = $newInquiry['checkinDate'];
        $inquiry->checkout_date          = $newInquiry['checkoutDate'];
        $inquiry->no_adults              = $newInquiry['noAdults'];
        $inquiry->no_kids                = $newInquiry['noKids'];
        $inquiry->ip_address             = rand(1000, 9999); //to-do: need to save real ip address
        $inquiry->status                 = 1;
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

    public function updateInquiryStatus(RepoModel $inquiry, int $status=null)
    {
        $inquiry->status =$status;
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

}
