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
        // 1. daftar_informasis
        if (Schema::hasTable('daftar_informasis')) {
            Schema::table('daftar_informasis', function (Blueprint $table) {
                if (!Schema::hasColumn('daftar_informasis', 'tautan_links')) {
                    $table->json('tautan_links')->nullable()->after('file_informasi');
                }
            });
        }

        // 2. informasi_berkalas
        if (Schema::hasTable('informasi_berkalas')) {
            Schema::table('informasi_berkalas', function (Blueprint $table) {
                if (!Schema::hasColumn('informasi_berkalas', 'tautan_links')) {
                    $table->json('tautan_links')->nullable()->after('file_path');
                }
                if (!Schema::hasColumn('informasi_berkalas', 'pejabat_penguasa')) {
                    $table->string('pejabat_penguasa')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'penanggung_jawab')) {
                    $table->string('penanggung_jawab')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'penerbit_informasi')) {
                    $table->string('penerbit_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'bentuk_informasi')) {
                    $table->string('bentuk_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'tempat_pembuatan')) {
                    $table->string('tempat_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'waktu_pembuatan')) {
                    $table->string('waktu_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_berkalas', 'jangka_waktu')) {
                    $table->string('jangka_waktu')->nullable();
                }
            });
        }

        // 3. informasi_setiapsaats
        if (Schema::hasTable('informasi_setiapsaats')) {
            Schema::table('informasi_setiapsaats', function (Blueprint $table) {
                if (!Schema::hasColumn('informasi_setiapsaats', 'tautan_links')) {
                    $table->json('tautan_links')->nullable()->after('file_path');
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'pejabat_penguasa')) {
                    $table->string('pejabat_penguasa')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'penanggung_jawab')) {
                    $table->string('penanggung_jawab')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'penerbit_informasi')) {
                    $table->string('penerbit_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'bentuk_informasi')) {
                    $table->string('bentuk_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'tempat_pembuatan')) {
                    $table->string('tempat_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'waktu_pembuatan')) {
                    $table->string('waktu_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_setiapsaats', 'jangka_waktu')) {
                    $table->string('jangka_waktu')->nullable();
                }
            });
        }

        // 4. informasi_sertamertas
        if (Schema::hasTable('informasi_sertamertas')) {
            Schema::table('informasi_sertamertas', function (Blueprint $table) {
                if (!Schema::hasColumn('informasi_sertamertas', 'tautan_links')) {
                    $table->json('tautan_links')->nullable()->after('file_path');
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'pejabat_penguasa')) {
                    $table->string('pejabat_penguasa')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'penanggung_jawab')) {
                    $table->string('penanggung_jawab')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'penerbit_informasi')) {
                    $table->string('penerbit_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'bentuk_informasi')) {
                    $table->string('bentuk_informasi')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'tempat_pembuatan')) {
                    $table->string('tempat_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'waktu_pembuatan')) {
                    $table->string('waktu_pembuatan')->nullable();
                }
                if (!Schema::hasColumn('informasi_sertamertas', 'jangka_waktu')) {
                    $table->string('jangka_waktu')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('daftar_informasis')) {
            Schema::table('daftar_informasis', function (Blueprint $table) {
                if (Schema::hasColumn('daftar_informasis', 'tautan_links')) {
                    $table->dropColumn('tautan_links');
                }
            });
        }

        $extraCols = [
            'tautan_links', 'pejabat_penguasa', 'penanggung_jawab',
            'penerbit_informasi', 'bentuk_informasi', 'tempat_pembuatan',
            'waktu_pembuatan', 'jangka_waktu'
        ];

        foreach (['informasi_berkalas', 'informasi_setiapsaats', 'informasi_sertamertas'] as $tbl) {
            if (Schema::hasTable($tbl)) {
                Schema::table($tbl, function (Blueprint $table) use ($tbl, $extraCols) {
                    $dropList = [];
                    foreach ($extraCols as $c) {
                        if (Schema::hasColumn($tbl, $c)) {
                            $dropList[] = $c;
                        }
                    }
                    if (!empty($dropList)) {
                        $table->dropColumn($dropList);
                    }
                });
            }
        }
    }
};
