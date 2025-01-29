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
        Schema::create('sops', function (Blueprint $table) {
            $table->id('sop_id')->from(1111)->unsigned();
            $table->string('sop_judul')->nullable();
            $table->text('sop_isi')->nullable();
            $table->tinyInteger('sop_urutan')->nullable();
            $table->string('sop_gambar')->nullable();
            $table->string('sop_pdf')->nullable();
            $table->string('sop_publikasi')->nullable();
            $table->string('sop_popup')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sops');
    }
};
