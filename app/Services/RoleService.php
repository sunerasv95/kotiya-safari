<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Services\Contracts\RoleServiceInterface;
use Illuminate\Support\Str;

class RoleService implements RoleServiceInterface
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        PermissionRepositoryInterface $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function getAllRoles()
    {
        try {

            return $this->roleRepository->all();
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAllPermissions()
    {
        try {

            return $this->permissionRepository->all();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getRoleByCode(string $roleCode)
    {
        try {

            $relations = ["permissions:permission_code,permission_name"];
            return $this->roleRepository->findByCode($roleCode, $relations);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function saveRole(array $roleData)
    {
        $result = [
            "error" => true,
            "message" => "Role creating failed"
        ];

        try {

            $roleData['role_code'] = Str::uuid();
            $roleData['role_slug'] = Str::slug($roleData['role_name']);

            $roleExists = $this->roleRepository->findBySlug($roleData['role_slug']);

            if(isset($roleExists)){
                $result['message'] = "Role is already exists!";
                return $result;
            }

            if($roleData['role_slug'] === "super-administrator" || $roleData['role_slug'] === "super-admin"){
                $result['message'] = "Role name is not allowed!";
                return $result;
            }

            $savedRole = $this->roleRepository->save($roleData);

            if(isset($savedRole)){
                $result['error'] = false;
                $result['message'] = "Role is created!";
                return $result;
            }

            return $result;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateRole(string $roleCode, array $updateData)
    {
        $result = [
            "error" => true,
            "message" => "Role updating failed"
        ];

        try {

            $roleToUpdate = $this->roleRepository->findByCode($roleCode);

            if(!isset($roleToUpdate)){
                $result['message'] = "Role is not found!";
                return $result;
            }

            if($roleToUpdate->role_slug === "super-administrator" || $roleToUpdate->level === 1){
                $result['message'] = "Action is not allowed!";
                return $result;
            }

            if(isset($updateData['role_name'])){
                $updateName = $updateData['role_name'];
                $updateData['role_slug'] = Str::slug($updateName);
            }

            $updated = $this->roleRepository->update($roleToUpdate, $updateData);

            if(isset($updated)){
                $result['error'] = false;
                $result['message'] = "Role is updated!";
                return $result;
            }

            return $result;

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    public function deactiveRole(Role $role)
    {

    }

    public function activeRole(Role $role)
    {
        
    }

}
