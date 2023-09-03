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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['Admin', 'Client', 'Freelancer']);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
    php artisan make:model Job -m
    php artisan make:model Bid -m
    php artisan make:model Message -m
    php artisan make:model Review -m
    php artisan make:model Payment -m

     */

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
