<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = DB::table('roles')->find(1);
        //dd($role);
        Admin::factory()->create(["role_id" => $role->id]);

        // Admin::factory()
        //     ->has(BlogPost::factory()->count(6)->has(BlogPostImage::factory()->count(2),'blogPostImages'),'blogPost')
        //     ->create(["role_id" => $role->id]);
    }
}
