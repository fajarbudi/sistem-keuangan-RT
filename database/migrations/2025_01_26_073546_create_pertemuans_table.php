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
        Schema::create('pertemuans', function (Blueprint $table) {
            $table->id('pertemuan_id')->from(22)->unsigned();
            $table->string('pertemuan_nama')->nullable();
            // $table->integer('jenis_iuran_id')->unsigned()->nullable();
            $table->date('pertemuan_tgl')->nullable();
            $table->string('pertemuan_kategori', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuans');
    }
};
