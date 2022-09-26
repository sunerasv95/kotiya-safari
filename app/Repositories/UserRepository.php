<?php

namespace App\Repositories;

use App\Constants\UserTypes;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{

    public function all(int $userType)
    {
        return User::where('user_type', $userType)->get();
    }

    public function allByRole(int $userType, int $roleId)
    {

    }

    public function findByEmail(string $email, array $with=[], int $userType)
    {
        return User::where('email', $email)
            ->when(!empty($with), function($q) use($with) {
                return $q->with($with);
            })
            ->first();
    }

    public function findByUsername(string $username, array $with = [], int $userType)
    {
        return User::where('username', $username)
            ->when(!empty($with), function($q) use($with) {
                return $q->with($with);
            })
            ->first();
    }

    public function findId(string $attribute, string $value)
    {
        return User::when($attribute !== null, function($q) use($attribute, $value){
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
        ->select('id')->first()->id;
    }

    public function save(array $userData= [], int $userType)
    {
        $user = new User();

        $user->name                 = $userData['name'];;
        $user->email                = $userData['email'];
        $user->username             = $userData['email'];
        $user->password             = Hash::make($userData['password']);
        $user->role_id              = $userType === UserTypes::ADMIN ? UserTypes::ADMIN_TYPE : UserTypes::GUEST_TYPE;
        $user->activated            = 1;
        $user->disabled             = 0;
        $user->email_verified_at    = null;
        $user->create_at            = now();
        $user->updated_at           = now();

        $user->save();

        return $user;
    }

    public function update(User $user, array $updateData = [])
    {
        return $user->update([
            "name" => $updateData['name'],
            "email" => $updateData['email'],
            "username" => $updateData['username'],
            "role_id" => $updateData['role_id']
        ]);
    }

    public function updatePassword(User $user, $oldPassword, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        return $user->save();
    }

    public function disable(User $user)
    {
        $user->disabled = 1;
        return $user->save();
    }

    public function enable(User $user)
    {
        $user->disabled = 0;
        return $user->save();
    }

    public function delete(User $user)
    {
        $user->activated = 0;
        return $user->save();
    }

    public function updateLastLogin(User $user, $loggedInIp)
    {
        $user->last_login_from = $loggedInIp;
        $user->last_login_at = now();

        return $user->save();
    }

}
