<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Model;

class saldo_sisa extends Model
{
    protected $primaryKey = "saldo_sisa_id";

    protected $fillable = [
        'saldo_sisa_status',
        'saldo_sisa_kategori',
        'saldo_jenis',
        'jenis_iuran_id',
        'saldo_sisa_tgl',
        'saldo_sisa_sebelum',
        'saldo_sisa_nominal',
        'saldo_sisa_sekarang',
    ];
}
