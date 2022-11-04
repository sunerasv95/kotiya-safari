<?php

namespace Database\Seeders;

use App\Constants\Types;
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
            Types::PENDING_STATUS,
            Types::RESERVED_STATUS,
            Types::REJECTED_STATUS
        ];

        foreach($status as $s){
            DB::table('inquiry_status')->insert([
                "status_name" => $s,
                "display_name" => ucfirst($s),
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
