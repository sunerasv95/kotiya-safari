<?php

namespace App\Repositories;

use App\Models\Admin as ModelAdmin;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface
{

    public function findAllAdminUsers()
    {
        return ModelAdmin::get();
    }

    public function findAdminUserByEmail(string $email, $with=[])
    {
        return ModelAdmin::where('email', $email)
            ->when(!empty($with), function($q) use($with) {
                return $q->with($with);
            })
            ->first();
    }

    public function saveAdminUser(array $newAdminUser)
    {
        $newAdmin = new ModelAdmin();

        $newAdmin->name               = $newAdminUser['name'];;
        $newAdmin->email              = $newAdminUser['email'];
        $newAdmin->admin_code         = "ADU".rand(1000, 9999);
        $newAdmin->email_verified_at  = null;
        $newAdmin->password           = Hash::make($newAdminUser['password']);
        $newAdmin->remember_token     = null;
        $newAdmin->status             = 0;
        $newAdmin->create_at          = now();
        $newAdmin->updated_at         = now();

        return $newAdmin->save();

    }

}
