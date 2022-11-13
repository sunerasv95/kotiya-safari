<?php

namespace App\Services;

use App\Models\BoardingPlan;
use App\Models\PaymentOption;
use App\Services\Contracts\CommonServiceInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class CommonService implements CommonServiceInterface
{
    public function retrieveDataFromJsonFile($fileName)
    {
        try {
            $path = storage_path() . "\app\data\\${fileName}.json";
            return json_decode(file_get_contents($path), true);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function retrieveCountryList()
    {
        try {
            $countries = DB::table('countries')
                ->get([
                    'country',
                    'abbreviation',
                    'dial_code'
                ]);
            return json_decode($countries, true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function retriveInquiryStatus()
    {
        try {
            $status = DB::table('inquiry_status')->get();
            return json_decode($status, true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function retriveReservationStatus()
    {
        try {
            $status = DB::table('reservation_status')->get();
            return json_decode($status, true);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function retrievePaymentOptions($optCode = null)
    {
        if (isset($optCode)) {
            return PaymentOption::where('pay_option_code', $optCode)
                ?->first([
                    'pay_option_name',
                    'pay_option_code'
                ])
                ?->toArray();
        }

        return PaymentOption::get(['pay_option_name', 'pay_option_code'])
            ?->toArray();
    }

    public function retrieveBoardingPlans($planCode = null)
    {
        if (isset($planCode)) {
            return BoardingPlan::where('boarding_plan_code', $planCode)
                ?->first([
                    'boarding_plan_name',
                    'boarding_plan_code'
                ])
                ?->toArray();
        }

        return BoardingPlan::get(['boarding_plan_name', 'boarding_plan_code'])
            ?->toArray();
    }
}
