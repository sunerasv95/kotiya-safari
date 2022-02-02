<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface StorageServiceInterface
{
    public function storeImageInLocalStorage(Request $request, string $path);

    public function removeImageInLocalStorage(string $imageName, string $path);
}
