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
        // Pivot table for the many-to-many relationship between users and boycotts
        Schema::create('boycott_user', function (Blueprint $table) {
            $table->id();
            // Foreign key linking to the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Foreign key linking to the boycotts table
            $table->foreignId('boycott_id')->constrained()->onDelete('cascade');
            $table->timestamps(); // Optional: track when a user joined the boycott

            // Ensure a user can only join a specific boycott once
            $table->unique(['user_id', 'boycott_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boycott_user');
    }
};
