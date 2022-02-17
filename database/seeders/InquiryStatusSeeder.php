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
        $status = [
            0 => ['status' => "PENDING", 'dname' => "Pending"],
            1 => ['status' => "RES_ADDED", 'dname' => "Reservation Added"],
            2 => ['status' => "REJECTED", 'dname' => "Rejected"]
        ];

        foreach($status as $i){
            DB::table('inquiry_status')->insert([
                "status_name" => $i['status'],
                "display_name" => $i['dname'],
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
