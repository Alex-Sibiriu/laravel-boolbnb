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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('state', 45);
            $table->string('city', 45);
            $table->string('street', 100);
            $table->string('street_number', 10);
            $table->tinyInteger('floor')->nullable();
            $table->string('postal_code', 10);
            $table->decimal('latitude', 9,6);
            $table->decimal('longitude', 9,6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
