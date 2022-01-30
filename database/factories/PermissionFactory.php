<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "permission_name"   => "Dashboard",
            "permission_slug"   => Str::slug("Dashboard"),
            "status"            => 1,
            "created_at"        => now(),
            "updated_at"        => now()
        ];
    }
}
