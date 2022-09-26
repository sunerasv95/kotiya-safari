<?php

namespace App\Repositories\Contracts;

use App\Models\Role;
use App\Models\User;

interface UserRepositoryInterface
{
    public function all(int $userType);

    public function allByRole(int $userType, int $roleId);

    public function findByEmail(string $email, array $with=[], int $userType);

    public function findByUsername(string $username, array $with = [], int $userType);

    public function findId(string $attribute, string $value);

    public function save(array $userData= [], int $userType);

    public function update(User $user, array $updateData = []);

    public function updatePassword(User $user, $oldPassword, $newPassword);

    public function disable(User $user);

    public function enable(User $user);

    public function delete(User $user);

    public function updateLastLogin(User $user, $loggedInIp);

}
