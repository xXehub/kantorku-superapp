<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles and instansi for assignment
        $superadminRole = \App\Models\Role::where('nama_role', 'Super Admin')->first();
        $adminRole = \App\Models\Role::where('nama_role', 'Admin')->first();
        $managerRole = \App\Models\Role::where('nama_role', 'Manager')->first();
        $staffRole = \App\Models\Role::where('nama_role', 'Staff')->first();
        
        $disdik = \App\Models\Instansi::where('nama_instansi', 'Dinas Pendidikan Kota Surabaya')->first();
        $dinkes = \App\Models\Instansi::where('nama_instansi', 'Dinas Kesehatan Kota Surabaya')->first();
        $dinsos = \App\Models\Instansi::where('nama_instansi', 'Dinas Sosial Kota Surabaya')->first();
        $dpu = \App\Models\Instansi::where('nama_instansi', 'Dinas Pekerjaan Umum Kota Surabaya')->first();
        $setda = \App\Models\Instansi::where('nama_instansi', 'Sekretariat Daerah Kota Surabaya')->first();

        $users = [
            [
                'name' => 'Super Administrator',
                'username' => 'superadmin',
                'email' => 'superadmin@surabaya.go.id',
                'password' => Hash::make('superadmin123'),
                'is_superadmin' => true,
                'role_id' => null,
                'instansi_id' => null,
                'app_id' => null,
            ],
            // Admin untuk setiap instansi
            [
                'name' => 'Admin Dinas Pendidikan',
                'username' => 'admin_disdik',
                'email' => 'admin@disdik.surabaya.go.id',
                'password' => Hash::make('admin123'),
                'is_superadmin' => false,
                'role_id' => $adminRole?->id,
                'instansi_id' => $disdik?->id,
                'app_id' => null, // Admin instansi bisa kelola semua app di instansinya
            ],
            [
                'name' => 'Admin Dinas Kesehatan',
                'username' => 'admin_dinkes',
                'email' => 'admin@dinkes.surabaya.go.id',
                'password' => Hash::make('admin123'),
                'is_superadmin' => false,
                'role_id' => $adminRole?->id,
                'instansi_id' => $dinkes?->id,
                'app_id' => null,
            ],
            [
                'name' => 'Admin Dinas Sosial',
                'username' => 'admin_dinsos',
                'email' => 'admin@dinsos.surabaya.go.id',
                'password' => Hash::make('admin123'),
                'is_superadmin' => false,
                'role_id' => $adminRole?->id,
                'instansi_id' => $dinsos?->id,
                'app_id' => null,
            ],
            // Manager untuk beberapa aplikasi
            [
                'name' => 'Manager SIAKAD',
                'username' => 'mgr_siakad',
                'email' => 'manager.siakad@disdik.surabaya.go.id',
                'password' => Hash::make('manager123'),
                'is_superadmin' => false,
                'role_id' => $managerRole?->id,
                'instansi_id' => $disdik?->id,
                'app_id' => null, // Manager app-specific akan diset setelah app ada
            ],
            [
                'name' => 'Manager SIMRS',
                'username' => 'mgr_simrs',
                'email' => 'manager.simrs@dinkes.surabaya.go.id',
                'password' => Hash::make('manager123'),
                'is_superadmin' => false,
                'role_id' => $managerRole?->id,
                'instansi_id' => $dinkes?->id,
                'app_id' => null,
            ],
            // Staff reguler
            [
                'name' => 'Staff Pendidikan',
                'username' => 'staff_disdik',
                'email' => 'staff@disdik.surabaya.go.id',
                'password' => Hash::make('staff123'),
                'is_superadmin' => false,
                'role_id' => $staffRole?->id,
                'instansi_id' => $disdik?->id,
                'app_id' => null,
            ],
            [
                'name' => 'Staff Kesehatan',
                'username' => 'staff_dinkes',
                'email' => 'staff@dinkes.surabaya.go.id',
                'password' => Hash::make('staff123'),
                'is_superadmin' => false,
                'role_id' => $staffRole?->id,
                'instansi_id' => $dinkes?->id,
                'app_id' => null,
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
