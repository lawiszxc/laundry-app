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
        Schema::create('rider_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookingID')->nullable();
            $table->unsignedBigInteger('riderID')->nullable();
            $table->timestamps();

            $table->foreign('bookingID')
            ->references('id')
            ->on('bookings')
            ->onDelete('CASCADE');

            $table->foreign('riderID')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_deliveries');
    }
};
