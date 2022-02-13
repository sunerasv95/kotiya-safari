<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquiryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ["Pending", "Reservation Added", "Rejected"];

        foreach($status as $i){
            DB::table('inquiry_status')->insert([
                "status_name" => $i,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
