<?php

namespace App\Models\data;

use App\Models\referensi\ref_jenis_iuran;
use Illuminate\Database\Eloquent\Model;

class iuran extends Model
{
    protected $primaryKey = "iuran_id";

    protected $fillable = [
        'pertemuan_id',
        'jenis_iuran_id',
        'iuran_status',
        'iuran_kategori'
    ];

    public function jenis_iuran()
    {
        return $this->hasOne(ref_jenis_iuran::class, 'jenis_iuran_id', 'jenis_iuran_id');
    }
    public function pertemuan()
    {
        return $this->hasOne(pertemuan::class, 'pertemuan_id', 'pertemuan_id');
    }
}
