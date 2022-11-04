<?php

namespace Database\Seeders;

use App\Constants\Types;
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
        $status = [
            Types::PENDING_STATUS,
            Types::DEPOSIT_PAID_STATUS,
            Types::COMPLETED_STATUS,
            Types::RESCHEDULED_STATUS,
            Types::CANCELLED_STATUS
        ];

        foreach($status as $i){
            DB::table('reservation_status')->insert([
                "status_name" => $i,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
