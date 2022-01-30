<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "role_name" => "Super Administrator",
            "role_code" => "RC12345",
            "status"    => 1,
            "created_at"=> now(),
            "updated_at"=> now()
        ];
    }
}
