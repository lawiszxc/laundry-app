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
        Schema::create('remittances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userID')->nullable();
            $table->unsignedBigInteger('bookingID')->nullable();
            $table->string('collected')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('userID')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');

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
        Schema::dropIfExists('remittances');
    }
};
