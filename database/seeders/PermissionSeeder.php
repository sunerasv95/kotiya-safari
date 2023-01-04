<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = array(
            "Dashboard",
            "Inquiries",
            "Reservations",
            "Reports"
        );

        $actions = ["Create", "Update", "View"];

        foreach($modules as $module){
            foreach($actions as $action){
                $pname = $module. " ". $action;
                Permission::factory()->create([
                    "permission_name" =>  $pname,
                    "permission_slug" => Str::slug($pname)
                ]);
            }
           
        }

    }
}
