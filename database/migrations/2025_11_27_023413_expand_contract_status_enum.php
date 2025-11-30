<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE contracts MODIFY COLUMN status ENUM('Active', 'Completed', 'Pending', 'Rejected', 'Terminated') NOT NULL DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE contracts MODIFY COLUMN status ENUM('Active', 'Completed', 'Pending') NOT NULL DEFAULT 'Pending'");
    }
};