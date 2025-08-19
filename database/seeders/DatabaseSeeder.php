<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the main seeders in order - roles must be created first
        $this->call([
            RolePermissionSeeder::class,
            IteracareSeeder::class,
            ReferralCodeSeeder::class,
            TestimonialIsApprovedSeeder::class,
        ]);
    }
}
