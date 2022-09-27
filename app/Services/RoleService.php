<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Services\Contracts\RoleServiceInterface;

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

    public function getRoleByCode(string $roleCode)
    {
        try {
            return $this->roleRepository->findByCode($roleCode, ["permissions:permission_code,permission_name"]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function saveRole(array $roleData)
    {

    }

    public function updateRole(array $roleData)
    {

    }

    public function deactiveRole(Role $role)
    {

    }

    public function activeRole(Role $role)
    {
        
    }

}
