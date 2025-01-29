<?php

namespace App\Models\referensi;

use Illuminate\Database\Eloquent\Model;

class ref_jenis_saldo_masuk extends Model
{
    protected $primaryKey = "jenis_saldo_masuk_id";

    protected $fillable = [
        'jenis_saldo_masuk_nama',
        'jenis_saldo_masuk_kategori'
    ];
}
