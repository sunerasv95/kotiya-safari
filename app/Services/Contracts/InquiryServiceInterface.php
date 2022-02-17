<?php

namespace App\Services\Contracts;

interface InquiryServiceInterface
{
    public function getAllInquiries($status = null);

    public function getAllValueAddedServices();

    public function getInquiryByReferenceNumber(string $inquiryRefNumber);

    public function createInquiry(array $newInquiry);

    public function updateInquiry(array $updateOrderData);

    public function rejectInquiry(array $rejectData);
}
