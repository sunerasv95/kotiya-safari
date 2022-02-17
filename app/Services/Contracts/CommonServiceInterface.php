<?php

namespace App\Services\Contracts;

interface CommonServiceInterface
{
    public function retrieveDataFromJsonFile($fileName);

    public function retriveCountryList();

    public function retriveInquiryStatus();
}
