<?php

namespace App\Repositories\Contracts;

interface PermissionRepositoryInterface
{
    public function all();

    public function findByCode(string $code);

    public function findId(string $attribute, string $value);

}
