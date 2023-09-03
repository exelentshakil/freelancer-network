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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_status', ['Pending', 'Completed']);
            $table->timestamps();

            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('freelancer_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
