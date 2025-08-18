<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'sales'])->default('sales')->after('email');
            $table->string('phone')->nullable()->after('role');
            $table->string('referral_code')->unique()->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('referral_code');
            $table->text('bio')->nullable()->after('is_active');
            $table->string('instagram')->nullable()->after('bio');
            $table->string('facebook')->nullable()->after('instagram');
            $table->string('whatsapp')->nullable()->after('facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'referral_code', 'is_active', 'bio', 'instagram', 'facebook', 'whatsapp']);
        });
    }
};
