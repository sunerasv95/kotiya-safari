<?php

namespace App\Services;

use App\Services\Contracts\CommonServiceInterface;
use Illuminate\Support\Facades\DB;
use Throwable;

class CommonService implements CommonServiceInterface
{
    public function retrieveDataFromJsonFile($fileName)
    {
        try {
            $path = storage_path(). "\app\data\\${fileName}.json";
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
}
