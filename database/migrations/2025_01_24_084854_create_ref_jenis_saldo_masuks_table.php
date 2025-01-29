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
        Schema::create('ref_jenis_saldo_masuks', function (Blueprint $table) {
            $table->id('jenis_saldo_masuk_id')->from(22)->unsigned();
            $table->string('jenis_saldo_masuk_nama')->nullable();
            $table->string('jenis_saldo_masuk_kategori', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_jenis_saldo_masuks');
    }
};
