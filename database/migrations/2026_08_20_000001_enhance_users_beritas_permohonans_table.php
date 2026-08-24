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
        // 1. Update Users Table
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'username')) {
                    $table->string('username')->nullable()->unique()->after('name');
                }
                if (!Schema::hasColumn('users', 'jenis_identitas')) {
                    $table->string('jenis_identitas')->default('ktp')->nullable()->after('email');
                }
                if (!Schema::hasColumn('users', 'nomor_identitas')) {
                    $table->string('nomor_identitas')->nullable()->after('jenis_identitas');
                }
                if (!Schema::hasColumn('users', 'file_identitas')) {
                    $table->string('file_identitas')->nullable()->after('nomor_identitas');
                }
                if (!Schema::hasColumn('users', 'alamat')) {
                    $table->text('alamat')->nullable()->after('file_identitas');
                }
                if (!Schema::hasColumn('users', 'no_telp')) {
                    $table->string('no_telp')->nullable()->after('alamat');
                }
                if (!Schema::hasColumn('users', 'pekerjaan')) {
                    $table->string('pekerjaan')->nullable()->after('no_telp');
                }
                if (!Schema::hasColumn('users', 'instansi')) {
                    $table->string('instansi')->nullable()->after('pekerjaan');
                }
                if (!Schema::hasColumn('users', 'status_verifikasi')) {
                    $table->string('status_verifikasi')->default('pending')->after('instansi');
                }
                if (!Schema::hasColumn('users', 'catatan_verifikasi')) {
                    $table->text('catatan_verifikasi')->nullable()->after('status_verifikasi');
                }
            });
        }

        // 2. Update Beritas Table for PKTJ live sync
        if (Schema::hasTable('beritas')) {
            Schema::table('beritas', function (Blueprint $table) {
                if (!Schema::hasColumn('beritas', 'link_sumber')) {
                    $table->string('link_sumber')->nullable()->after('slug');
                }
                if (!Schema::hasColumn('beritas', 'guid')) {
                    $table->string('guid')->nullable()->after('link_sumber');
                }
                if (!Schema::hasColumn('beritas', 'is_external')) {
                    $table->boolean('is_external')->default(false)->after('guid');
                }
            });
        }

        // 3. Update Permohonans Table
        $permohonanTable = Schema::hasTable('permohonans') ? 'permohonans' : (Schema::hasTable('permohonan') ? 'permohonan' : null);
        if ($permohonanTable) {
            Schema::table($permohonanTable, function (Blueprint $table) use ($permohonanTable) {
                if (!Schema::hasColumn($permohonanTable, 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
                }
                if (!Schema::hasColumn($permohonanTable, 'nomor_registrasi')) {
                    $table->string('nomor_registrasi')->nullable()->after('user_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $columns = ['username', 'jenis_identitas', 'nomor_identitas', 'file_identitas', 'alamat', 'no_telp', 'pekerjaan', 'instansi', 'status_verifikasi', 'catatan_verifikasi'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('users', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('beritas')) {
            Schema::table('beritas', function (Blueprint $table) {
                $columns = ['link_sumber', 'guid', 'is_external'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('beritas', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }

        if (Schema::hasTable('permohonan')) {
            Schema::table('permohonan', function (Blueprint $table) {
                $columns = ['user_id', 'nomor_registrasi'];
                foreach ($columns as $column) {
                    if (Schema::hasColumn('permohonan', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
};
