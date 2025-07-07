<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            // User Management
            ['name' => 'users.view', 'display_name' => 'View Users', 'description' => 'Can view user list', 'group' => 'users'],
            ['name' => 'users.create', 'display_name' => 'Create Users', 'description' => 'Can create new users', 'group' => 'users'],
            ['name' => 'users.edit', 'display_name' => 'Edit Users', 'description' => 'Can edit user information', 'group' => 'users'],
            ['name' => 'users.delete', 'display_name' => 'Delete Users', 'description' => 'Can delete users', 'group' => 'users'],
            ['name' => 'users.assign', 'display_name' => 'Assign Users', 'description' => 'Can assign users to apps/instansi', 'group' => 'users'],

            // Role Management
            ['name' => 'roles.view', 'display_name' => 'View Roles', 'description' => 'Can view role list', 'group' => 'roles'],
            ['name' => 'roles.create', 'display_name' => 'Create Roles', 'description' => 'Can create new roles', 'group' => 'roles'],
            ['name' => 'roles.edit', 'display_name' => 'Edit Roles', 'description' => 'Can edit role information', 'group' => 'roles'],
            ['name' => 'roles.delete', 'display_name' => 'Delete Roles', 'description' => 'Can delete roles', 'group' => 'roles'],
            ['name' => 'roles.permissions', 'display_name' => 'Manage Role Permissions', 'description' => 'Can manage role permissions', 'group' => 'roles'],

            // App Management
            ['name' => 'apps.view', 'display_name' => 'View Apps', 'description' => 'Can view app list', 'group' => 'apps'],
            ['name' => 'apps.create', 'display_name' => 'Create Apps', 'description' => 'Can create new apps', 'group' => 'apps'],
            ['name' => 'apps.edit', 'display_name' => 'Edit Apps', 'description' => 'Can edit app information', 'group' => 'apps'],
            ['name' => 'apps.delete', 'display_name' => 'Delete Apps', 'description' => 'Can delete apps', 'group' => 'apps'],

            // Instansi Management
            ['name' => 'instansi.view', 'display_name' => 'View Instansi', 'description' => 'Can view instansi list', 'group' => 'instansi'],
            ['name' => 'instansi.create', 'display_name' => 'Create Instansi', 'description' => 'Can create new instansi', 'group' => 'instansi'],
            ['name' => 'instansi.edit', 'display_name' => 'Edit Instansi', 'description' => 'Can edit instansi information', 'group' => 'instansi'],
            ['name' => 'instansi.delete', 'display_name' => 'Delete Instansi', 'description' => 'Can delete instansi', 'group' => 'instansi'],

            // Permission Management
            ['name' => 'permissions.view', 'display_name' => 'View Permissions', 'description' => 'Can view permission list', 'group' => 'permissions'],
            ['name' => 'permissions.create', 'display_name' => 'Create Permissions', 'description' => 'Can create new permissions', 'group' => 'permissions'],
            ['name' => 'permissions.edit', 'display_name' => 'Edit Permissions', 'description' => 'Can edit permission information', 'group' => 'permissions'],
            ['name' => 'permissions.delete', 'display_name' => 'Delete Permissions', 'description' => 'Can delete permissions', 'group' => 'permissions'],

            // General/App-specific permissions
            ['name' => 'dashboard.view', 'display_name' => 'View Dashboard', 'description' => 'Can access dashboard', 'group' => 'general'],
            ['name' => 'reports.view', 'display_name' => 'View Reports', 'description' => 'Can view reports', 'group' => 'general'],
            ['name' => 'settings.view', 'display_name' => 'View Settings', 'description' => 'Can view settings', 'group' => 'general'],
            ['name' => 'settings.edit', 'display_name' => 'Edit Settings', 'description' => 'Can edit settings', 'group' => 'general'],
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // Assign permissions to roles
        $this->assignPermissionsToRoles();
    }

    private function assignPermissionsToRoles()
    {
        // Superadmin gets all permissions (handled in User model)
        
        // Admin role - full management permissions
        $adminRole = Role::where('nama_role', 'Administrator')->first();
        if ($adminRole) {
            $adminPermissions = [
                'users.view', 'users.create', 'users.edit', 'users.assign',
                'roles.view', 'roles.create', 'roles.edit', 'roles.permissions',
                'apps.view', 'apps.create', 'apps.edit',
                'instansi.view', 'instansi.create', 'instansi.edit',
                'dashboard.view', 'reports.view', 'settings.view', 'settings.edit'
            ];
            $adminRole->syncPermissions($adminPermissions);
        }

        // Manager role - limited management
        $managerRole = Role::where('nama_role', 'Manager')->first();
        if ($managerRole) {
            $managerPermissions = [
                'users.view', 'users.edit',
                'roles.view',
                'apps.view',
                'instansi.view',
                'dashboard.view', 'reports.view', 'settings.view'
            ];
            $managerRole->syncPermissions($managerPermissions);
        }

        // User role - basic permissions
        $userRole = Role::where('nama_role', 'User')->first();
        if ($userRole) {
            $userPermissions = [
                'dashboard.view'
            ];
            $userRole->syncPermissions($userPermissions);
        }
    }
}
