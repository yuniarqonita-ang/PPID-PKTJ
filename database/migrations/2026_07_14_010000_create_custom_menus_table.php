<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('custom_menus')->nullOnDelete();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('url')->nullable(); // For external or custom hardcoded route redirects
            $table->longText('konten')->nullable(); // HTML content
            $table->boolean('is_editor')->default(false); // Enable TinyMCE content editor
            $table->boolean('is_table')->default(false);  // Render structured table
            $table->boolean('is_chart')->default(false);  // Render flow chart / diagram
            $table->boolean('is_form')->default(false);   // Render standard form
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_menus');
    }
};
