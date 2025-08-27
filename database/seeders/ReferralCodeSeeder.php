<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferralCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReferralCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create referral codes for only sales users
        $salesUsers = User::where('role', 'sales')->get();

        foreach ($salesUsers as $user) {
            // generate a base code from the name (alphanumeric lowercase)
            $base = strtolower(preg_replace('/[^a-z0-9]/', '', $user->name));
            $code = $base ?: 'user' . $user->id;

            // ensure uniqueness by appending a numeric suffix when necessary
            $suffix = 0;
            while (ReferralCode::where('code', $code)->exists()) {
                $suffix++;
                $code = $base . ($suffix ?: '') . ($suffix ? $user->id : '');
            }

            // Use updateOrCreate keyed by user_id to avoid duplicate entries
            DB::transaction(function () use ($user, $code) {
                $ref = ReferralCode::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'code' => $code,
                        'name' => $user->name,
                        'usage_count' => 0,
                        'is_active' => true,
                    ]
                );

                // keep user's referral_code in sync
                $user->referral_code = $code;
                $user->save();
            });
        }
    }
}

