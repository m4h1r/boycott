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
        Schema::create('boycotts', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to the brands table
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            // Slug for the boycott, unique identifier
            $table->string('slug')->unique();
            // Reason for the boycott
            $table->text('reason');
            // Start date of the boycott
            $table->dateTime('start_date');
            // End date of the boycott (optional)
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boycotts');
    }
};
