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
        Schema::create('peraturans', function (Blueprint $table) {
            $table->id('peraturan_id')->from(1111)->unsigned();
            $table->string('peraturan_judul')->nullable();
            $table->text('peraturan_isi')->nullable();
            $table->tinyInteger('peraturan_urutan')->nullable();
            $table->string('peraturan_gambar')->nullable();
            $table->string('peraturan_pdf')->nullable();
            $table->string('peraturan_publikasi')->nullable();
            $table->string('peraturan_popup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peraturans');
    }
};
