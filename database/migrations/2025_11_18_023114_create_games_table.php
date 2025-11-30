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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team1_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('team2_id')->constrained('users')->onDelete('restrict');
            $table->integer('points1')->default(0);
            $table->integer('points2')->default(0);
            $table->foreignId('referee_id')->constrained('users')->onDelete('restrict');
            $table->date('date');
            $table->tinyInteger('referee_rating')->nullable();
            $table->enum('game_status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();

            $table->index('date');
            $table->index('team1_id');
            $table->index('team2_id');
            $table->index('referee_id');
            $table->index('game_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
