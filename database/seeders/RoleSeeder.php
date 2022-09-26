<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = ["Super Administrator", "Accountant", "Editor"];

        //create roles
        foreach($userTypes as $type){
            Role::factory()->create([
                "role_name" => $type
            ]);
        }

        
    }
}
