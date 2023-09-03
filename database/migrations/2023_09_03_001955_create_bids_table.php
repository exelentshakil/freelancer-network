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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('job_id');
            $table->text('proposal');
            $table->decimal('bid_amount', 10, 2);
            $table->enum('status', ['Pending', 'Accepted', 'Rejected']);
            $table->timestamps();

            $table->foreign('freelancer_id')->references('id')->on('users');
            $table->foreign('job_id')->references('id')->on('jobs');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
