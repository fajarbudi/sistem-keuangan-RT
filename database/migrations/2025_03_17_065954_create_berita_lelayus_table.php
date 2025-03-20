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
        Schema::create('berita_lelayus', function (Blueprint $table) {
            $table->id('berita_lelayu_id');
            $table->string('berita_lelayu_nama')->nullable();
            $table->string('berita_lelayu_jenis_kelamin')->nullable();
            $table->integer('berita_lelayu_umur')->unsigned()->nullable();
            $table->string('berita_lelayu_alamat')->nullable();
            $table->date('berita_lelayu_tgl')->nullable();
            $table->string('berita_lelayu_jam')->nullable();
            $table->date('berita_lelayu_dimakamkan')->nullable();
            $table->string('berita_lelayu_dimakamkan_jam')->nullable();
            $table->string('berita_lelayu_dimakamkan_tempat')->nullable();
            $table->text('berita_lelayu_keluarga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_lelayus');
    }
};
