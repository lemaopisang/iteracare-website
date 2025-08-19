<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Schema;

class TestimonialIsApprovedSeeder extends Seeder
{
    public function run(): void
    {
        // If testimonials exist, set is_approved to match is_active for backward compatibility
        if (Schema::hasColumn('testimonials', 'is_approved')) {
            Testimonial::query()->update(['is_approved' => Testimonial::raw('COALESCE(is_active, 0)')]);
        }
    }
}
