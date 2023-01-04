<?php

namespace App\Services\Contracts;

interface InquiryServiceInterface
{
    public function getAllInquiries($status = null);

    public function getInquiryByReferenceNumber(string $inquiryRefNumber);

    public function createInquiry(array $newInquiry, string $requestType);

    public function updateInquiry(array $updateOrderData);

    public function rejectInquiry(array $rejectData);
}
