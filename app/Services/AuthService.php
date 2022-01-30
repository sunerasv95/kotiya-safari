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
        //dd($username, $password);
        $authenticated = false;
        $message = "Login Failed";
        $data = null;

        $adminUser = $this->adminRepository->findAdminUserByEmail($username, ['role', 'role.permissions']);
        if(isset($adminUser)){
            $hashedPassword = hash(env('HASHING_METHOD'), $password);
            if($adminUser->password === $hashedPassword){
                $authenticated = true;
                $message = "Login Success!";

                $data['full_name']  = $adminUser->name;
                $data['role']       = $adminUser->role->role_name;
                $data['_adminId']   = $adminUser->admin_code;
                $data['_roleId']    = $adminUser->admin_code;
                $data['_permissions']= $adminUser->role->permissions->map(function($permission){
                    return $permission->permission_slug;
                })->toArray();
                // dd($data);
            }else{
                $authenticated = false;
                $message = "Invalid username & passwords!";
            }
        }else{
            $authenticated = false;
            $message = "Invalid username & passwordss!";
        }

        return [
            "success" => $authenticated,
            "message" => $message,
            "data" => $data
        ];
    }
}
