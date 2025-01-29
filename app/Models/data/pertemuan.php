<?php

namespace App\Models\data;

use App\Models\referensi\ref_jenis_iuran;
use Illuminate\Database\Eloquent\Model;

class pertemuan extends Model
{
    protected $primaryKey = "pertemuan_id";

    protected $fillable = [
        'pertemuan_nama',
        'pertemuan_kategori',
        'pertemuan_tgl',
    ];

    // public function iuran()
    // {
    //     return $this->hasOne(ref_jenis_iuran::class, 'jenis_iuran_id', 'jenis_iuran_id');
    // }
}
