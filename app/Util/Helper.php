<?php

use App\Constants\Types;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (!function_exists('carbonParse')) {
    function carbonParse($dateTime)
    {
        return Carbon::parse($dateTime);
    }
}


if (!function_exists('generateReferenceNumber')) {
    function generateReferenceNumber($type = null)
    {
        $ref = null;

        switch ($type) {
            case Types::BOOKING:
                $ref = Types::BOOKING_REF_PREFIX . rand(1000000, 9999999);
                break;

            default:
                $ref = rand(1000000, 9999999);
        }

        return $ref;
    }
}



if (!function_exists('storeCurrentUserSession')) {
    function storeCurrentUserSession($loginData)
    {
        if (session()->has('_amToken')) {
            session()->forget('_amToken');
        }
        $encryptedData = encrypt((array)$loginData);
        session()->put('_amToken', $encryptedData);
    }
}

if (!function_exists('retriveCurrentUserSession')) {
    function retriveCurrentUserSession()
    {
        if (session()->has('_amToken')) {
            $sessionData = session()->get('_amToken');
            return decrypt($sessionData);
        }
    }
}

if (!function_exists('isCurrentUser')) {
    function isCurrentUser($currentAdminId)
    {
        $isCurrent = false;
        $currentUser = retriveCurrentUserSession();
        if (isset($currentUser)) {
            $isCurrent = $currentUser['_adminId'] === $currentAdminId;
        }

        return $isCurrent;
    }
}

if (!function_exists('removeCurrentUserSession')) {
    function removeCurrentUserSession()
    {
        if (session()->has('_amToken')) {
            session()->forget('_amToken');
        }
    }
}

if (!function_exists('findCountryIdByCode')) {
    function findCountryIdByCode($countryCode)
    {
        return DB::table('countries')->where('abbreviation', $countryCode)?->first()->id;
    }
}
