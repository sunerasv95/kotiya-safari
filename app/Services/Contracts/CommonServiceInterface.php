<?php

namespace App\Services\Contracts;

interface CommonServiceInterface
{
    public function retrieveDataFromJsonFile($fileName);

    public function retrieveCountryList();

    public function retriveInquiryStatus();

    public function retriveReservationStatus();

    public function retrievePaymentOptions($optCode = null);

    public function retrieveBoardingPlans($planCode = null);
}
