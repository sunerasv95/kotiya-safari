<?php

namespace App\Services;

use App\Constants\UserTypes;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function adminSignIn($username, $password)
    {
        $result = [
            "error" => false,
            "message" => null
        ];

        try {
            $adminUser = $this->userRepository->findByEmail($username, ["role"], UserTypes::ADMIN_TYPE);

            if(!isset($adminUser)){
                return [
                    "error" => true,
                    "message" => "Invalid User or Password"
                ];
            }

            if (!Hash::check($password, $adminUser->password)) {
                return [
                    "error" => true,
                    "message" => "Invalid Password"
                ];
            }

            $data['_username']      = $adminUser->username;
            $data['_roleId']        = $adminUser->role_id;
            $data['_permissions']   = $adminUser->role->permissions->map(function ($permission) {
                return $permission->permission_slug;
            })->toArray();

            //store user in session
            storeCurrentUserSession($data);

            $result['error'] = false;
            $result['message'] = "Login Success!";

            return $result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function adminLogout()
    {
        removeCurrentUserSession();
    }


}
