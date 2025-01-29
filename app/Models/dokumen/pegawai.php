<?php

namespace App\Models\dokumen;

use App\Models\referensi\ref_bidang;
use App\Models\referensi\ref_eselon;
use App\Models\referensi\ref_golongan;
use App\Models\referensi\ref_jabatan;
use App\Models\referensi\ref_pendidikan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = "pegawai_id";

    protected $fillable = [
        'pegawai_nama',
        'pegawai_nip',
        'pegawai_tempat_lahir',
        'pegawai_tgl_lahir',
        'pegawai_kelamin',
        'pegawai_status',
        'pegawai_alamat',
        'pegawai_ktp',
        'pegawai_npwp',
        'pegawai_hp',
        'pegawai_email',
        'pegawai_email_pupr',
        'pegawai_agama',
        'pegawai_tmt_cpns',
        'golongan_id',
        'pegawai_masa_kerja_golongan',
        'pegawai_tmt_golongan',
        'jabatan_id',
        'pegawai_tmt_jabatan',
        'pegawai_nomor_sk',
        'pegawai_diklat',
        'pendidikan_id',
        'pegawai_tahun_lulus',
        'pegawai_sekolah',
        'pegawai_bidang_studi',
        'pegawai_jurusan',
        'pegawai_tmt_pensiun',
        'pegawai_foto',
        'bidang_id',
        'pegawai_mulai_masa_kerja_golongan',
        'pegawai_penandatangan',
        'pegawai_sebagai_atasan',
        'pegawai_gaji_pokok',
        'atasan_id'
    ];
    public function ref_atasan()
    {
        return $this->hasOne(pegawai::class, 'pegawai_id', 'atasan_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
