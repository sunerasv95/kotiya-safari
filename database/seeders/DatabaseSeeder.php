<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminSeeder::class,
            BlogPostSeeder::class,
            InquirySeeder::class,
            VASSeeder::class,
            InquiryStatusSeeder::class,
            ReservationStatusSeeder::class,
            CountrySeeder::class
        ]);
    }
}
