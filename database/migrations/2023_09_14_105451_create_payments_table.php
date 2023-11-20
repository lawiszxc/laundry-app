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
            $table->unsignedBigInteger('bookingID')->nullable();
            $table->string('paymentType')->nullable();
            $table->string('gcashReferenceNum')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('bookingID')
            ->references('id')
            ->on('bookings')
            ->onDelete('CASCADE');
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
