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
        // Add missing columns to beritas table
        Schema::table('beritas', function (Blueprint $table) {
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('beritas', 'judul')) {
                $table->string('judul')->after('id');
            }
            if (!Schema::hasColumn('beritas', 'slug')) {
                $table->string('slug')->unique()->after('judul');
            }
            if (!Schema::hasColumn('beritas', 'konten')) {
                $table->longText('konten')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('beritas', 'gambar')) {
                $table->string('gambar')->nullable()->after('konten');
            }
            if (!Schema::hasColumn('beritas', 'kategori_id')) {
                $table->unsignedBigInteger('kategori_id')->nullable()->after('gambar');
            }
            if (!Schema::hasColumn('beritas', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('kategori_id');
            }
            if (!Schema::hasColumn('beritas', 'views')) {
                $table->bigInteger('views')->default(0)->after('is_published');
            }
        });
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
