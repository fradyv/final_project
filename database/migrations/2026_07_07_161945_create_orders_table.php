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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->decimal('subtotal_products', 15, 2)->default(0);
            $table->decimal('additional_donation', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods')->onDelete('set null');
            $table->string('bank_name')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->boolean('is_anonymous')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('campaign_id');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
