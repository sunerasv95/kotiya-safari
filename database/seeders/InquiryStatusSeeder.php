<?php

namespace Database\Seeders;

use App\Constants\StatusTypes;
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
            StatusTypes::PENDING,
            StatusTypes::RESERVED,
            StatusTypes::REJECTED
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
