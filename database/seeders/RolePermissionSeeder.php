<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::get();
        Role::factory()
            ->hasAttached(
                $permissions, [
                    "created_at"=> now(),
                    "updated_at"=> now()
                ])->create();
    }
}
