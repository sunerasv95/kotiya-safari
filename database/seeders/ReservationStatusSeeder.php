<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ["PENDING", "PAR_PAID", "COMPLETED", "RE_SCHE", "CANCELLED"];
        foreach($status as $i){
            DB::table('reservation_status')->insert([
                "status_name" => $i,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
