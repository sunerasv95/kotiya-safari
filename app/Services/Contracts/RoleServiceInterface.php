<?php

namespace App\Services\Contracts;

use App\Models\Role;

interface RoleServiceInterface
{
    public function getAllRoles();

    public function getRoleByCode(string $rolCode);

    public function saveRole(array $roleData);

    public function updateRole(array $roleData);

    public function deactiveRole(Role $role);

    public function activeRole(Role $role);

}