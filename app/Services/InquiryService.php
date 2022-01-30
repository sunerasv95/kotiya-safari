<?php

namespace App\Services;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Services\Contracts\InquiryServiceInterface;

class InquiryService implements InquiryServiceInterface
{
    private $inquiryRepository;

    public function __construct(InquiryRepositoryInterface $inquiryRepository)
    {
        $this->inquiryRepository = $inquiryRepository;
    }

    public function getAllInquiries()
    {
        try {
            return $this->inquiryRepository->findAllInquiries()->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getInquiryByReferenceNumber(string $inquiryRefNumber)
    {
        try {
            return $this->inquiryRepository
                ->findInquiryByReferenceNumber($inquiryRefNumber)
                ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createInquiry(array $newInquiry)
    {
        try {
            $savedInquiry = $this->inquiryRepository->saveInquiry($newInquiry);
            return $savedInquiry;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
