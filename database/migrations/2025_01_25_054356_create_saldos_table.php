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
        Schema::create('saldos', function (Blueprint $table) {
            $table->id('saldo_id')->from(22)->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('saldo_keterangan')->nullable();
            $table->string('saldo_status')->nullable();
            $table->string('saldo_kategori', 5)->nullable();
            $table->integer('saldo_jenis')->unsigned()->nullable();
            $table->date('saldo_tgl')->nullable();
            $table->float('saldo_nominal')->nullable();
            $table->float('saldo_total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldos');
    }
};
