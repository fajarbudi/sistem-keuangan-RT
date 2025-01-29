<?php

namespace App\Models\referensi;

use Illuminate\Database\Eloquent\Model;

class ref_jenis_iuran extends Model
{
    protected $primaryKey = "jenis_iuran_id";

    protected $fillable = [
        'jenis_iuran_nama',
        'jenis_iuran_kategori'
    ];
}
