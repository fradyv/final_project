<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fundraiser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('ktp_number');
            $table->string('ktp_photo');
            $table->string('selfieandktp_photo');
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('bank_account_name');
            $table->string('passbook_photo');
            $table->string('statement_letter');
            $table->string('other_docs')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fundraiser');
    }
};
