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
        Schema::create('ref_jenis_iurans', function (Blueprint $table) {
            $table->id('jenis_iuran_id')->from(22)->unsigned();
            $table->integer('penanggung_jawab')->unsigned()->nullable();
            $table->string('jenis_iuran_nama')->nullable();
            $table->string('jenis_iuran_kategori', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_jenis_iurans');
    }
};
