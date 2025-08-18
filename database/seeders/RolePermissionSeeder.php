<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use only the basic Spatie permissions and roles
        $roles = ['admin', 'sales'];
        $permissions = ['view-admin-panel', 'manage-users', 'manage-testimonials', 'manage-referral-codes'];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Assign all permissions to admin
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions($permissions);

        // Assign only referral code and testimonial management to sales
        $salesRole = Role::where('name', 'sales')->first();
        $salesRole->syncPermissions(['manage-testimonials', 'manage-referral-codes']);
    }
}
