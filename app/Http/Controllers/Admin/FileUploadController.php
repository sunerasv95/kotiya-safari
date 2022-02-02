<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\StorageServiceInterface;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{

    private $storageService;

    public function __construct(StorageServiceInterface $storageService)
    {
        $this->storageService = $storageService;
    }

    public function uploadImage(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "file" => "required|file|mimes:jpg,png"
        ]);

        $uploadLocation = "blog";

        $result = $this->storageService->storeImageInLocalStorage($request, $uploadLocation);
        return $result;
    }

    public function removeImage(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "imageName" => "required"
        ]);

        $imageName = $request["imageName"];
        $location = "blog";

        $deleted = $this->storageService->removeImageInLocalStorage($imageName, $location);
        return $deleted;
    }
}
