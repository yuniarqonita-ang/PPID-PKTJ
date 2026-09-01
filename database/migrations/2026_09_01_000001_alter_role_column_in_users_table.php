<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            try {
                DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) NOT NULL DEFAULT 'operator'");
            } catch (\Throwable $e) {}
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            try {
                DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'operator') NOT NULL DEFAULT 'operator'");
            } catch (\Throwable $e) {}
        }
    }
};
