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
        return [
            "name" => $this->faker->name('male'),
            "email" => "test@app.com",
            "admin_code" => "ADU".rand(1000, 9999),
            "email_verified_at" => null,
            "password" => hash(env('HASHING_METHOD'), "Test123"),//Hash::make("Test123"),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
