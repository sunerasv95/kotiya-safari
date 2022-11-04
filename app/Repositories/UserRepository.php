<?php

namespace App\Repositories;

use App\Constants\UserTypes;
use App\Models\Admin;
use App\Models\Guest;
use App\Models\User;
use App\Models\UserType;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function allAdmins()
    {
        return Admin::get();
    }

    public function allGuests()
    {
        return Guest::get();
    }

    public function findAdmin(string $attribute, string $value, array $with=[])
    {
        return Admin::when($attribute !== null, function($q) use($attribute, $value){
            switch($attribute){
                case "email":
                    $q->where("email", $value);
                break;

                case "admin_code":
                    $q->where("admin_code", $value);
                break;

                default:
                    $q->where("email", $value);
            }
            return $q;
        })
        ?->first();
    }

    public function findGuest(string $attribute, string $value)
    {
        return Guest::when($attribute !== null, function($q) use($attribute, $value){
            switch($attribute){
                case "email":
                    $q->where("email", $value);
                break;

                case "username":
                    $q->where("username", $value);
                break;

                default:
                    $q->where("email", $value);
            }
            return $q;
        })
        ?->first();
    }

    public function getAdminId(string $attribute, string $value)
    {
        return $this->findAdmin($attribute, $value)?->id;
    }

    public function getGuestId(string $attribute, string $value)
    {
        return $this->findGuest($attribute, $value)?->id;
    }

    public function saveAdmin(array $data= [])
    {
        $admin = new Admin();

        $admin->name                 = $data['full_name'];;
        $admin->email                = $data['email'];
        $admin->password             = $data['password'];
        $admin->role_id              = $data['role_id'];
        $admin->activated            = 1;
        $admin->deleted              = 0;
        $admin->created_at           = now();
        $admin->updated_at           = now();

        $admin->save();

        return $admin;
    }

    public function saveGuest(array $data= [])
    {
        $guest = new Guest();

        $guest->name                 = $data['full_name'];
        $guest->email                = $data['email'];
        $guest->password             = $data['password'];
        $guest->country_id           = $data['country_id'];
        $guest->activated            = 1;
        $guest->disabled             = 0;
        $guest->email_verified_at    = null;
        $guest->created_at           = now();
        $guest->updated_at           = now();

        $guest->save();

        return $guest;
    }

    public function updateAdmin(Admin $admin, array $data = [])
    {
        return $admin->update([
            "name" => $data['name'],
            "email" => $data['email'],
            "role_id" => $data['role_id']
        ]);
    }

    public function updateAdminPassword(Admin $admin, $oldPassword, $newPassword)
    {
        $admin->password = Hash::make($newPassword);
        return $admin->save();
    }

    public function deleteAdmin(Admin $admin)
    {
        $admin->deleted = 1;
        return $admin->save();
    }

    public function activateAdmin(Admin $admin)
    {
        $admin->activated = 1;
        return $admin->save();
    }

    public function deactivateAdmin(Admin $admin)
    {
        $admin->activated = 0;
        return $admin->save();
    }

    public function updateAdminLastLogin(Admin $admin, $loggedInIp)
    {
        $admin->last_login_from = $loggedInIp;
        $admin->last_login_at = now();

        return $admin->save();
    }

}
