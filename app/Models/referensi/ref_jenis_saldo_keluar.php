<?php

namespace App\Models\referensi;

use Illuminate\Database\Eloquent\Model;

class ref_jenis_saldo_keluar extends Model
{
    protected $primaryKey = "jenis_saldo_keluar_id";

    protected $fillable = [
        'jenis_saldo_keluar_nama',
        'jenis_saldo_keluar_kategori'
    ];
}
