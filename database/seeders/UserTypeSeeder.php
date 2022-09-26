<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = ['Admin', 'Guest'];

        foreach($userTypes as $type){
            DB::table('user_types')->insert([
                "user_type"=> $type,
                "status" => 1,
                "created_at"=> now(),
                "updated_at"=> now()
            ]);
        }
    }
}
