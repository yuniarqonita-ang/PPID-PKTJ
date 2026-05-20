<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations — drop keberatans table permanently.
     */
    public function up(): void
    {
        Schema::dropIfExists('keberatans');
    }

    /**
     * Reverse the migrations (tidak bisa dikembalikan).
     */
    public function down(): void
    {
        // Tabel ini tidak dikembalikan — penghapusan permanen
    }
};
