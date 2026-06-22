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
        schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('fundraiser', function (Blueprint $table) {
            $table->id();
            $table->foreignID('user_id');
            $table->varchar('ktp_number');
            $table->mediumblob('ktp_photo');
            $table->mediumblob('selfieandktp_photo');
            $table->string('bank_name');
            $table->bigInteger('bank_account_number');
            $table->string('bank_account_name');
            $table->mediumblob('passbook_photo');
            $table->mediumblob('statement_letter');
            $table->mediumblob('other_docs')->nullable();
            //table status jangan lupa
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
