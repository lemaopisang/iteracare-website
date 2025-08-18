<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralCode;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ReferralCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create referral codes for only sales users
        $salesUsers = \App\Models\User::where('role', 'sales')->get();
        foreach ($salesUsers as $user) {
            $code = strtolower(preg_replace('/[^a-z0-9]/', '', $user->name));
            \App\Models\ReferralCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'name' => $user->name,
                'usage_count' => 0,
                'is_active' => true,
            ]);
            $user->referral_code = $code;
            $user->save();
        }
        // No static or test referral codes for production
    }
}

