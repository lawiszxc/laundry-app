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
        Schema::create('transaction_load_kilos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transactionID')->nullable();
            $table->unsignedBigInteger('type')->nullable();
            $table->integer('kilo')->nullable();
            $table->timestamps();

            $table->foreign('transactionID')
            ->references('id')
            ->on('transactions')
            ->onDelete('CASCADE');

            $table->foreign('type')
            ->references('id')
            ->on('laundry_kilos')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_load_kilos');
    }
};
