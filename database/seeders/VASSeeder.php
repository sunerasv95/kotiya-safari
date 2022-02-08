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
        $path = storage_path(). "\app\data\\vas.json";
        $serviceContent = json_decode(file_get_contents($path), true);

        foreach($serviceContent as $service){
            DB::table('value_added_services')->insert([
                "service_name" => $service["serviceName"],
                "service_description" => "test description",
                "service_code" => $service["serviceCode"],
                "status" => 1,
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
