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
        Schema::create('saldo_sisas', function (Blueprint $table) {
            $table->id('saldo_sisa_id');
            $table->string('saldo_sisa_status')->nullable();
            $table->string('saldo_sisa_kategori', 5)->nullable();
            $table->integer('saldo_jenis')->unsigned()->nullable();
            $table->integer('jenis_iuran_id')->unsigned()->nullable();
            $table->float('saldo_sisa_sebelum')->nullable();
            $table->float('saldo_sisa_nominal')->nullable();
            $table->float('saldo_sisa_sekarang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_sisas');
    }
};
