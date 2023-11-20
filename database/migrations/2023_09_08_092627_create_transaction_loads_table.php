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
        Schema::create('transaction_loads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionID')->nullable();
            $table->unsignedBigInteger('loadID')->nullable();
            $table->integer('load')->nullable();
            $table->unsignedBigInteger('service')->nullable();
            $table->unsignedBigInteger('detergent')->nullable();
            $table->unsignedBigInteger('bleach')->nullable();
            $table->timestamps();

            $table->foreign('transactionID')
            ->references('id')
            ->on('transactions')
            ->onDelete('CASCADE');

            $table->foreign('loadID')
            ->references('id')
            ->on('laundry_loads')
            ->onDelete('CASCADE');

            $table->foreign('service')
            ->references('id')
            ->on('services')
            ->onDelete('CASCADE');

            $table->foreign('detergent')
            ->references('id')
            ->on('detergents')
            ->onDelete('CASCADE');

            $table->foreign('bleach')
            ->references('id')
            ->on('bleaches')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_loads');
    }
};
