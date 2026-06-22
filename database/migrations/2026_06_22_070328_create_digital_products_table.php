<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('digital_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 15, 2);
            $table->integer('stock');
            $table->string('product_preview');
            $table->string('category');
            $table->string('file_url');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('digital_products');
    }
};
