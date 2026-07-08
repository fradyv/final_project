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
            if (!Schema::hasColumn('users', 'display_name')) {
                $table->string('display_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'legal_name')) {
                $table->string('legal_name')->nullable()->after('display_name');
            }
            if (!Schema::hasColumn('users', 'profile_photo')) {
                $table->string('profile_photo')->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('profile_photo');
            }
            if (!Schema::hasColumn('users', 'donate_anonymously')) {
                $table->boolean('donate_anonymously')->default(false)->after('bio');
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('donate_anonymously');
            }
            if (!Schema::hasColumn('users', 'legal_name_locked_at')) {
                $table->timestamp('legal_name_locked_at')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('users', 'two_factor_enabled')) {
                $table->boolean('two_factor_enabled')->default(false)->after('legal_name_locked_at');
            }
            if (!Schema::hasColumn('users', 'two_factor_secret')) {
                $table->string('two_factor_secret')->nullable()->after('two_factor_enabled');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'display_name',
                'legal_name',
                'profile_photo',
                'bio',
                'donate_anonymously',
                'is_active',
                'legal_name_locked_at',
                'two_factor_enabled',
                'two_factor_secret'
            ]);
        });
    }
};
