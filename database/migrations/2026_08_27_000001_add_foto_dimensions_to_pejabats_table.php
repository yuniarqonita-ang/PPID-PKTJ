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
        if (Schema::hasTable('pejabats')) {
            Schema::table('pejabats', function (Blueprint $table) {
                if (!Schema::hasColumn('pejabats', 'foto_width')) {
                    $table->integer('foto_width')->nullable()->default(160)->after('foto');
                }
                if (!Schema::hasColumn('pejabats', 'foto_height')) {
                    $table->integer('foto_height')->nullable()->default(240)->after('foto_width');
                }
                if (!Schema::hasColumn('pejabats', 'foto_card_height')) {
                    $table->integer('foto_card_height')->nullable()->default(390)->after('foto_height');
                }
                if (!Schema::hasColumn('pejabats', 'foto_position')) {
                    $table->string('foto_position')->nullable()->default('top center')->after('foto_card_height');
                }
                if (!Schema::hasColumn('pejabats', 'foto_radius')) {
                    $table->string('foto_radius')->nullable()->default('14px')->after('foto_position');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pejabats')) {
            Schema::table('pejabats', function (Blueprint $table) {
                $columns = ['foto_width', 'foto_height', 'foto_card_height', 'foto_position', 'foto_radius'];
                foreach ($columns as $col) {
                    if (Schema::hasColumn('pejabats', $col)) {
                        $table->dropColumn($col);
                    }
                }
            });
        }
    }
};
