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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('delivery_city');
            $table->string('delivery_town');
            $table->string('delivery_street');
            $table->string('delivery_region');
            $table->string('delivery_fee');
            $table->string('delivery_time');
            $table->string('status')->default('pending'); // pending, paid, cancelled, success
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
