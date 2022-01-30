<?php

namespace App\Services\Contracts;

interface InquiryServiceInterface
{
    public function getAllInquiries();

    public function getInquiryByReferenceNumber(string $inquiryRefNumber);

    public function createInquiry(array $newInquiry);
}
