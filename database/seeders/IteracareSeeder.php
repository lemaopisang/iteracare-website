<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class IteracareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $salesRole = Role::firstOrCreate(['name' => 'sales']);

        // Seed only the main admin user (no dummy password)
        $admin = User::where('email', 'prifeindonesia@gmail.com')->first();
        if ($admin) {
            $admin->update([
                'password' => bcrypt(env('ADMIN_PASSWORD', 'change_this_password')),
                'role' => 'admin',
                'phone' => null,
            ]);
        } else {
            $admin = User::create([
                'name' => 'Admin Prife Indonesia',
                'email' => 'prifeindonesia@gmail.com',
                'password' => bcrypt(env('ADMIN_PASSWORD', 'change_this_password')),
                'role' => 'admin',
                'phone' => null,
            ]);
        }
        $admin->assignRole($adminRole);
        // No sales users or testimonials seeded for production
    }
}
