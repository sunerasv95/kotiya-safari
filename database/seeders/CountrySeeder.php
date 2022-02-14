<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path(). "\app\data\\countries.json";
        $countriesContent = json_decode(file_get_contents($path), true);

        foreach($countriesContent as $country){
            DB::table('countries')->insert([
                "country" => $country["country"],
                "abbreviation" => $country['abbreviation'],
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }
}
