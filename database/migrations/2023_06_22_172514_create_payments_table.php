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
            $table->foreignId('order_id');
            $table->string('amount');
            $table->string('status')->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_reference')->nullable();
            $table->string('transaction_status')->nullable(); // success, failed, pending
            $table->timestamps();
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
