<?php

namespace App\Repositories\Contracts;

interface InquiryRepositoryInterface
{
    public function findAllInquiries();

    public function findInquiryByReferenceNumber(string $inquiryRefNumber);

    public function saveInquiry(array $newInquiry);
}
