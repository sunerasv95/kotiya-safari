<?php

namespace App\Services;

use App\Services\Contracts\StorageServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class StorageService implements StorageServiceInterface
{
    public function storeImageInLocalStorage(Request $request, string $path)
    {
        try {
            $storedLocation = null;

            $fileName       = "IMG".now()->addMinutes(2)->timestamp;
            $fileExtension  = $request->file("file")->getClientOriginalExtension();
            $imageName      =  $fileName.".".$fileExtension;


            if($request->has("file")){
                $storedLocation = Storage::putFileAs(
                    'public/'.$path,
                    $request->file("file"),
                    $imageName
                );
            }

            return array(
                "imageName" => $imageName,
                "imageUrl" => $storedLocation
            );
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function removeImageInLocalStorage(string $imageName, string $path)
    {
        try {
            return Storage::delete("public/${path}/${imageName}");
        } catch (Throwable $th) {
            throw $th;
        }
    }

}
