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
        Schema::table('wallets', function (Blueprint $table) {
            $table->foreignId('fundraiser_id')->unique()->after('id')->constrained('fundraisers')->onDelete('cascade');
            $table->index('fundraiser_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropForeign(['fundraiser_id']);
            $table->dropIndex(['fundraiser_id']);
            $table->dropColumn('fundraiser_id');
        });
    }
};
