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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reviewer_id');
            $table->unsignedBigInteger('reviewee_id');
            $table->unsignedBigInteger('job_id');
            $table->integer('rating');
            $table->text('review_text');
            $table->timestamps();

            $table->foreign('reviewer_id')->references('id')->on('users');
            $table->foreign('reviewee_id')->references('id')->on('users');
            $table->foreign('job_id')->references('id')->on('jobs');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
