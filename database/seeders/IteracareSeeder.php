<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class IteracareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure permission cache is cleared so role creation/assignment works reliably
        if (class_exists(\Spatie\Permission\PermissionRegistrar::class)) {
            app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        }

        // Create roles (idempotent)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $salesRole = Role::firstOrCreate(['name' => 'sales']);

        // Use a transaction to create or update the main admin user reliably
        DB::transaction(function () use ($adminRole) {
            $email = 'prifeindonesia@gmail.com';

            $admin = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => 'Admin Prife Indonesia',
                    'password' => bcrypt(env('ADMIN_PASSWORD', 'change_this_password')),
                    'role' => 'admin',
                    'phone' => null,
                    'is_active' => true,
                    'email_verified_at' => now(),
                ]
            );

            // Ensure the admin has the admin role
            if (method_exists($admin, 'syncRoles')) {
                $admin->syncRoles(['admin']);
            } else {
                $admin->assignRole('admin');
            }
        });
    }
}
