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
        if (Schema::hasTable('pejabats') && !Schema::hasColumn('pejabats', 'lhkpn_links')) {
            Schema::table('pejabats', function (Blueprint $table) {
                $table->json('lhkpn_links')->nullable()->after('lhkpn_link');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pejabats') && Schema::hasColumn('pejabats', 'lhkpn_links')) {
            Schema::table('pejabats', function (Blueprint $table) {
                $table->dropColumn('lhkpn_links');
            });
        }
    }
};
