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
        Schema::create('ref_nominals', function (Blueprint $table) {
            $table->id('nominal_masuk_id')->from(22)->unsigned();
            $table->float('nominal_nominal');
            $table->string('nominal_kategori', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_nominals');
    }
};
