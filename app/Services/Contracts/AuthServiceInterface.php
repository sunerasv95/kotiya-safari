<?php

namespace App\Services\Contracts;

interface AuthServiceInterface
{
    public function adminSignIn($username, $password);

    public function adminLogout();
}
