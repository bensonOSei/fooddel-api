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
        Schema::create('Restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('region');
            $table->string('contact');
            $table->foreignId('user_id')->cascadeOnDelete();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Restaurant');
    }
};
