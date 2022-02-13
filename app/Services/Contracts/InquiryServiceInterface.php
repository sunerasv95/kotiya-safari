<?php

namespace App\Services\Contracts;

interface InquiryServiceInterface
{
    public function getAllInquiries();

    public function getAllValueAddedServices();

    public function getInquiryByReferenceNumber(string $inquiryRefNumber);

    public function createInquiry(array $newInquiry);

    public function updateInquiry(array $updateOrderData);
}
