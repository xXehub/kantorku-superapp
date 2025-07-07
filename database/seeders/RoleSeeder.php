<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nama_role' => 'Super Administrator',
                'description' => 'Super Administrator with full access',
                'is_default' => false,
            ],
            [
                'nama_role' => 'Administrator',
                'description' => 'Administrator with management access',
                'is_default' => false,
            ],
            [
                'nama_role' => 'Manager',
                'description' => 'Manager with limited management access',
                'is_default' => false,
            ],
            [
                'nama_role' => 'User',
                'description' => 'Regular user with basic access',
                'is_default' => true,
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['nama_role' => $role['nama_role']],
                $role
            );
        }
    }
}
