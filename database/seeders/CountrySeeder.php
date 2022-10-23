<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get('database/data/countries.json');
        $countriesContent = json_decode($json, true);

        foreach($countriesContent as $country){
            //dd($country);
            DB::table('countries')->insert([
                "country" => $country["country"],
                "abbreviation" => $country['abbreviation'],
                "dial_code" => $country['dial_code'],
                "created_at" => now(),
                "updated_at" => now()
            ]);
        }
    }

    
}
