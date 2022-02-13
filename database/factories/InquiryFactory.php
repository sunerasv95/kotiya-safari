<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "inquiry_reference_no" => $this->faker->randomNumber(8),
            "checkin_date" => Carbon::now()->addDays(2),
            "checkout_date" => Carbon::now()->addDays(4),
            "no_adults" => rand(1, 5),
            "no_kids" => rand(1, 3),
            "remark" => null,
            "status" => 1,
            "is_deleted" => 0,
            "ip_address" => $this->faker->ipv4(),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];
    }
}
