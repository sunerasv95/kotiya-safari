<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userTypes = ["Super Administrator", "Accountant", "Editor", "Content Manager", "Supervisor"];

        //create roles
        foreach($userTypes as $type){
            Role::factory()->create([
                "role_name" => $type,
                "role_slug" => Str::slug($type),
                "level" => Str::slug($type) === "super-administrator" ? 1: 0
            ]);
        }

        
    }
}
