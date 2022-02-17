<?php

namespace App\Repositories\Contracts;

interface AdminRepositoryInterface
{
    public function findAllAdminUsers();

    public function findAdminUserByEmail(string $email, $with=[]);

    public function findAdminId(string $adminCode);

    public function saveAdminUser(array $newInquiry);
}
