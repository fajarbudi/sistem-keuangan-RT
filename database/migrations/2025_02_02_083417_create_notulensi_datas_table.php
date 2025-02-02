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
        Schema::create('notulensi_datas', function (Blueprint $table) {
            $table->id('notulensi_data_id');
            $table->integer('notulensi_id')->unsigned();
            $table->integer('pertemuan_id')->unsigned();
            $table->text('notulensi_isi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulensi_datas');
    }
};
