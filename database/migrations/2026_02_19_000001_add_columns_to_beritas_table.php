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
        // Columns already added in create_beritas_table migration
        // This migration is kept for reference only
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beritas', function (Blueprint $table) {
            if (Schema::hasColumn('beritas', 'judul')) {
                $table->dropColumn('judul');
            }
            if (Schema::hasColumn('beritas', 'slug')) {
                $table->dropColumn('slug');
            }
            if (Schema::hasColumn('beritas', 'konten')) {
                $table->dropColumn('konten');
            }
            if (Schema::hasColumn('beritas', 'gambar')) {
                $table->dropColumn('gambar');
            }
            if (Schema::hasColumn('beritas', 'kategori_id')) {
                $table->dropColumn('kategori_id');
            }
            if (Schema::hasColumn('beritas', 'is_published')) {
                $table->dropColumn('is_published');
            }
            if (Schema::hasColumn('beritas', 'views')) {
                $table->dropColumn('views');
            }
        });
    }
};
