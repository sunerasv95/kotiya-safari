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
            "country_code" => 1100,
            "ip_address" => $this->faker->ipv4(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
