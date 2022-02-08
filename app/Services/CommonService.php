<?php

namespace App\Services;

use App\Services\Contracts\CommonServiceInterface;
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
}
