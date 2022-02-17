<?php

namespace App\Repositories;

use App\Models\Admin as RepoModel;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminRepository implements AdminRepositoryInterface
{

    public function findAllAdminUsers()
    {
        return RepoModel::get();
    }

    public function findAdminUserByEmail(string $email, $with=[])
    {
        return RepoModel::where('email', $email)
            ->when(!empty($with), function($q) use($with) {
                return $q->with($with);
            })
            ->first();
    }

    public function findAdminId(string $adminCode)
    {
        return RepoModel::where('admin_code', $adminCode)->select('id')->first()->id;
    }

    public function saveAdminUser(array $newAdminUser)
    {
        $admin = new RepoModel();

        $admin->name               = $newAdminUser['name'];;
        $admin->email              = $newAdminUser['email'];
        $admin->admin_code         = "ADU".rand(1000, 9999);
        $admin->email_verified_at  = null;
        $admin->password           = Hash::make($newAdminUser['password']);
        $admin->remember_token     = null;
        $admin->status             = 0;
        $admin->create_at          = now();
        $admin->updated_at         = now();

        return $admin->save();

    }

}
