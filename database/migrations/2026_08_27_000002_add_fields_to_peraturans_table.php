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
        Schema::table('peraturans', function (Blueprint $table) {
            if (!Schema::hasColumn('peraturans', 'tahun')) {
                $table->integer('tahun')->nullable()->after('nomor');
            }
            if (!Schema::hasColumn('peraturans', 'link_download')) {
                $table->string('link_download', 1000)->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('peraturans', 'file_name')) {
                $table->string('file_name')->nullable()->after('link_download');
            }
            if (!Schema::hasColumn('peraturans', 'urutan')) {
                $table->integer('urutan')->default(0)->after('kategori');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peraturans', function (Blueprint $table) {
            $cols = ['tahun', 'link_download', 'file_name', 'urutan'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('peraturans', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
