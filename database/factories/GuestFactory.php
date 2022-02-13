<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "guest_code"  => "GSU".rand(100000, 999999),
            "full_name"  => $this->faker->name('male'),
            "email" => $this->faker->email(),
            "is_email_verified" => 0,
            "country_code" => "SL",
            "last_login_ip" => $this->faker->ipv4(),
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now(),
            "email_verified_at" => null
        ];
    }
}
