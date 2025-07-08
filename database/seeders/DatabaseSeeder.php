<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            InstansiSeeder::class,
            KategoriAppSeeder::class,
            UserSeeder::class,
            MasterAppSeeder::class,
        ]);
    }
}
