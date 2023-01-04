<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                "name" => "Pre-Payment Required",
                "code" => "PP"
            ],
            [
                "name" => "Full Payment Required",
                "code" => "FP"
            ]
        ];

        for($o = 0; $o < count($options); $o++){
            DB::table('payment_options')->insert([
                "pay_option_name" => $options[$o]['name'],
                "pay_option_code" => $options[$o]['code'],
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
