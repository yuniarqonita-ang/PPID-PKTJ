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
        Schema::table('dokumens', function (Blueprint $table) {
            if (!Schema::hasColumn('dokumens', 'tanggal')) {
                $table->date('tanggal')->nullable()->after('kategori');
            }
            if (!Schema::hasColumn('dokumens', 'deskripsi')) {
                $table->longText('deskripsi')->nullable()->after('tanggal');
            }
            if (!Schema::hasColumn('dokumens', 'file_name')) {
                $table->string('file_name')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('dokumens', 'file_size')) {
                $table->string('file_size', 50)->nullable()->after('file_name');
            }
            if (!Schema::hasColumn('dokumens', 'file_type')) {
                $table->string('file_type', 100)->nullable()->after('file_size');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumens', function (Blueprint $table) {
            $table->dropColumn(['tanggal', 'deskripsi', 'file_name', 'file_size', 'file_type']);
        });
    }
};
