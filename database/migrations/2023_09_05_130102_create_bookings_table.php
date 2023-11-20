<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('transactionNum')->nullable();
            $table->unsignedBigInteger('userID')->nullable();
            $table->unsignedBigInteger('dropOffID')->nullable();
            $table->dateTime('selectedPickup')->nullable();
            $table->dateTime('selectedDelivery')->nullable();
            $table->string('homeAddress')->nullable();
            $table->string('status')->nullable();
            $table->integer('totalPrice')->nullable();
            $table->timestamps();

            $table->foreign('userID')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');

            $table->foreign('dropOffID')
            ->references('id')
            ->on('drop_offs')
            ->onDelete('CASCADE');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
