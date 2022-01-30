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
        $permissions = array(
            "Dashboard",
            "Inquiries",
            "Reservations",
            "Reports"
        );

        foreach($permissions as $permission){
            Permission::factory()->create([
                "permission_name" => $permission,
                "permission_slug" => Str::slug($permission)
            ]);
        }

    }
}
