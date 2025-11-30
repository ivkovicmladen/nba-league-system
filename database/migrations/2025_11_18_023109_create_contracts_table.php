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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->enum('status', ['Active', 'Completed', 'Pending'])->default('Pending');
            $table->decimal('salary', 12, 2);
            $table->enum('role', ['coach', 'player', 'referee']);
            $table->string('employer_id', 50);
            $table->timestamps();

            $table->index('user_id');
            $table->index('status');
            $table->index('role');
            $table->index('employer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
