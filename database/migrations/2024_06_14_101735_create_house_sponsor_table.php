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
        Schema::create('house_sponsor', function (Blueprint $table) {

            $table->unsignedBigInteger('house_id');

            $table->foreign('house_id')
                    ->references('id')
                    ->on('houses')
                    ->cascadeOnDelete();

            $table->unsignedBigInteger('sponsor_id');

            $table->foreign('sponsor_id')
                    ->references('id')
                    ->on('sponsors')
                    ->cascadeOnDelete();

            $table->dateTime('start_date');
            $table->dateTime('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_sponsor');
    }
};
