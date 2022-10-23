<?php

namespace App\Services\Contracts;

interface CommonServiceInterface
{
    public function retrieveDataFromJsonFile($fileName);

    public function retrieveCountryList();

    public function retriveInquiryStatus();
}
