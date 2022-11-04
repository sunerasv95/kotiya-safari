<?php

namespace App\Repositories\Contracts;

use App\Models\Admin;
use App\Models\Role;
use App\Models\User;

interface UserRepositoryInterface
{
    public function allAdmins();
    
    public function findAdmin(string $attribute, string $value, array $with=[]);

    public function getAdminId(string $attribute, string $value);

    public function saveAdmin(array $data= []);

    public function updateAdmin(Admin $user, array $updateData = []);

    public function updateAdminPassword(Admin $admin, $oldPassword, $newPassword);

    public function deleteAdmin(Admin $admin);

    public function activateAdmin(Admin $admin);

    public function deactivateAdmin(Admin $admin);

    public function updateAdminLastLogin(Admin $admin, $loggedInIp);

    public function allGuests();

    public function findGuest(string $attribute, string $value);
    
    public function getGuestId(string $attribute, string $value);

    public function saveGuest(array $data= []);

}
