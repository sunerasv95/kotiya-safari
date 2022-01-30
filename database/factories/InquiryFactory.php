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
            "req_date_start" => Carbon::now()->addDays(2),
            "req_date_to" => Carbon::now()->addDays(4),
            "boarding_plan_id" => 1,
            "no_adults" => rand(1, 5),
            "no_kids" => rand(1, 3),
            "pickup_required" => true,
            "status" => 0,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ];
    }
}
