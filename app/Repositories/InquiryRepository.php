<?php

namespace App\Repositories;

use App\Models\Inquiry as ModelInquiry;
use App\Repositories\Contracts\InquiryRepositoryInterface;

class InquiryRepository implements InquiryRepositoryInterface
{

    public function findAllInquiries()
    {
        return ModelInquiry::get();
    }

    public function findInquiryByReferenceNumber(string $inquiryRefNumber)
    {
        return ModelInquiry::where('inq_reference_no', $inquiryRefNumber)->first();
    }

    public function saveInquiry(array $newInquiry)
    {
        $newInquiry = new ModelInquiry();

        $newInquiry->inq_reference_no       = "KSQ" . rand(100000, 999999);
        $newInquiry->customer_name          = $newInquiry['customer_name'];
        $newInquiry->customer_email         = $newInquiry['customer_email'];
        $newInquiry->checkin_date           = $newInquiry['date_from'];
        $newInquiry->checkout_date          = $newInquiry['date_to'];
        $newInquiry->boarding_plan          = $newInquiry['board_plan'];
        $newInquiry->nof_adults             = $newInquiry['no_adults'];
        $newInquiry->nof_kids               = $newInquiry['no_kids'];
        $newInquiry->ip_address             = rand(1000, 9999); //to-do: need to save real ip address
        $newInquiry->inq_status             = 0;
        $newInquiry->create_at              = now();
        $newInquiry->updated_at             = now();

        return $newInquiry->save();

    }

}
