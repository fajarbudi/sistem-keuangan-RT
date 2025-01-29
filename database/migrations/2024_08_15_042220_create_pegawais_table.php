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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id('pegawai_id')->from(1111)->unsigned();
            $table->string('pegawai_nama')->nullable();
            $table->string('pegawai_nip', 55)->nullable();
            $table->string('pegawai_tempat_lahir')->nullable();
            $table->date('pegawai_tgl_lahir')->nullable();
            $table->string('pegawai_kelamin', 55)->nullable();
            $table->string('pegawai_status', 55)->nullable();
            $table->smallInteger('pegawai_status_urut')->unsigned()->nullable();
            $table->integer('atasan_id')->unsigned()->nullable();
            $table->string('pegawai_alamat')->nullable();
            $table->string('pegawai_ktp')->nullable();
            $table->string('pegawai_npwp')->nullable();
            $table->string('pegawai_hp', 55)->nullable();
            $table->string('pegawai_email')->nullable();
            $table->string('pegawai_email_pupr')->nullable();
            $table->string('pegawai_agama')->nullable();
            $table->date('pegawai_mulai_masa_kerja_golongan', 55)->nullable();
            $table->date('pegawai_tmt_cpns', 55)->nullable();
            $table->integer('golongan_id')->nullable()->unsigned();
            $table->integer('pegawai_masa_kerja_golongan')->nullable();
            $table->date('pegawai_tmt_golongan', 55)->nullable();
            $table->integer('jabatan_id')->nullable()->unsigned();
            $table->date('pegawai_tmt_jabatan', 55)->nullable();
            $table->string('pegawai_nomor_sk')->nullable();
            $table->string('pegawai_diklat')->nullable();
            $table->integer('pendidikan_id')->nullable()->unsigned();
            $table->year('pegawai_tahun_lulus')->nullable();
            $table->string('pegawai_sekolah')->nullable();
            $table->string('pegawai_bidang_studi')->nullable();
            $table->string('pegawai_jurusan')->nullable();
            $table->date('pegawai_tmt_pensiun', 55)->nullable();
            $table->string('pegawai_foto')->nullable();
            $table->integer('bidang_id')->unsigned()->nullable();
            $table->date('pegawai_mulai_masa_jabatan')->nullable();
            $table->string('pegawai_penandatangan')->nullable();
            $table->string('pegawai_sebagai_atasan')->nullable();
            $table->integer('pegawai_gaji_pokok')->nullable();
            $table->integer('created_by')->nullable()->unsigned();
            $table->integer('updated_by')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
