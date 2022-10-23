<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VASSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $services = [
            "Airport-pickup",
            "Wild Life Photography",
            "Safari",
            "Boat Rides"
      ];

        foreach($services as $k=> $service){
            $k++;
            DB::table('value_added_services')->insert([
                "service_name" => $service,
                "service_description" => "test description",
                "service_code" => "VAS000".$k,
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
