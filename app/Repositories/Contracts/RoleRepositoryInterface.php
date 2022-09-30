<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

interface RoleRepositoryInterface
{
    public function all();

    public function findByCode(string $code, $with = []);

    public function findBySlug(string $slug, $with = []);

    public function findId(string $attribute, string $value);

    public function save(array $roleData= []);

    public function update(Role $role, array $updateData = []);

    public function disable(Role $role);

    public function enable(Role $role);

}
