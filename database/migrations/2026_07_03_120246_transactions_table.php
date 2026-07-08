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
        Schema::create('transactions', function (Blueprint $table) {
             $table->id();
             $table->foreignId('buyer_id')->constrained('users')->cascadeOnDelete();
             $table->foreignId('product_id')->constrained()->cascadeOnDelete();
             $table->decimal('amount', 15, 2);
             $table->string('bank_name');
             $table->timestamp('payment_time')->nullable();
             $table->enum('status', ['pending', 'success', 'denied'])->default('pending');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
