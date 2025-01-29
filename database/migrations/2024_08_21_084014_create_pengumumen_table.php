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
        Schema::create('pengumumen', function (Blueprint $table) {
            $table->id('pengumuman_id')->from(1111)->unsigned();
            $table->string('pengumuman_judul')->nullable();
            $table->string('pengumuman_tipe')->nullable();
            $table->text('pengumuman_isi')->nullable();
            $table->tinyInteger('pengumuman_urutan')->nullable();
            $table->string('pengumuman_gambar')->nullable();
            $table->string('pengumuman_pdf')->nullable();
            $table->string('pengumuman_publikasi')->nullable();
            $table->string('pengumuman_popup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
