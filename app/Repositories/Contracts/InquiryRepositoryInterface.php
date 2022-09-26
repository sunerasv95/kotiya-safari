<?php

namespace App\Repositories\Contracts;

use App\Models\Inquiry;
use App\Models\User;

interface InquiryRepositoryInterface
{
    public function findAllInquiries($with=[], $status= null);

    public function findAllValueAddedServices();

    public function findInquiryByReferenceNumber(string $inquiryRefNumber, $with=[]);

    public function findInquiryById(int $inquiryId);

    public function save(array $newInquiry);

    public function updateInquiry(Inquiry $inquiry, array $updateInquiry);

    public function updateInquiryStatus(Inquiry $inquiry, string $status=null, string $remarkText = null, array $rejectData = []);

    public function inquiryCountByStatus($status = null);
}
