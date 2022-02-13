<?php

namespace App\Services;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Services\Contracts\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    private $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function adminSignIn($username, $password)
    {
        $result = [
            "error" => false,
            "message" => null
        ];

        try {
            $adminUser = $this->adminRepository->findAdminUserByEmail($username, ['role', 'role.permissions']);
            if (isset($adminUser)) {
                $hashedPassword = hash(env('HASHING_METHOD'), $password);
                if ($adminUser->password === $hashedPassword) {
                    $data['full_name']  = $adminUser->name;
                    $data['role']       = $adminUser->role->role_name;
                    $data['_adminId']   = $adminUser->admin_code;
                    $data['_roleId']    = $adminUser->admin_code;
                    $data['_permissions'] = $adminUser->role->permissions->map(function ($permission) {
                        return $permission->permission_slug;
                    })->toArray();

                    //store user in session
                    storeCurrentUserSession($data);

                    $result['error'] = false;
                    $result['message'] = "Login Success!";
                } else {
                    $result['error'] = true;
                    $result['message'] = "Invalid username or password!";
                }
            } else {
                $result['error'] = true;
                $result['message'] = "Invalid username or password!";
            }
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
