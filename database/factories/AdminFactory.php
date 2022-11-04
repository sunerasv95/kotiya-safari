<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = "sachisune@gmail.com";

        return [
            'admin_code'=> $this->faker->uuid(),
            'name' => $this->faker->name(),
            'email' =>  $email,
            "role_id" => null,
            'password' => Hash::make('test123'), // password
            "activated" => 1,
            "deleted" => 0,
            "last_login_from" => $this->faker->ipv4(),
            'email_verified_at' => now(),
            "last_login_at" => now(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
