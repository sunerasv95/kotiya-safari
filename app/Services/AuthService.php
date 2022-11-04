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

    public function adminSignIn($email, $password)
    {
        $result = [
            "error" => false,
            "message" => null
        ];

        try {
            $admin = $this->userRepository->findAdmin("email", $email, ["role"]);

            if(!isset($admin)){
                return [
                    "error" => true,
                    "message" => "Invalid User or Password"
                ];
            }

            if (!Hash::check($password, $admin->password)) {
                return [
                    "error" => true,
                    "message" => "Invalid Password"
                ];
            }

            $data['_adminId']       = $admin->admin_code;
            $data['_roleId']        = $admin->role_id;
            $data['_permissions']   = $admin->role->permissions->map(function ($permission) {
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
