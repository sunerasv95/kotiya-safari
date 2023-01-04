<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'name' => $this->faker->name(),
            'email' =>  $email,
            "username" =>  $email,
            "role_id" => null,
            'password' => Hash::make('test123'), // password
            "activated" => 1,
            "disabled" => 0,
            "last_login_from" => $this->faker->ipv4(),
            'email_verified_at' => now(),
            "last_login_at" => now(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }

    // /**
    //  * Indicate that the model's email address should be unverified.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Factories\Factory
    //  */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
