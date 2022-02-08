<?php

namespace App\Services;

use App\Repositories\Contracts\InquiryRepositoryInterface;
use App\Services\Contracts\ExternalApiCallsServiceInterface;
use Illuminate\Support\Facades\Http;

class ExternalApiCallsService implements ExternalApiCallsServiceInterface
{
    public function fetchWorldCountries()
    {
        $response = Http::get("https://api.first.org/data/v1/countries");
        dd(count((array) json_decode($response->body())->data));
    }
}

