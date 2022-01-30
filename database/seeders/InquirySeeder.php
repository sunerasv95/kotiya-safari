<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Inquiries;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inquiry::factory()->for(Guest::factory())->count(2)->create();
        Inquiry::factory()->for(Guest::factory())->count(1)->create();
    }
}
