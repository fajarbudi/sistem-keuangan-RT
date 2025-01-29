<?php

namespace App\Models\data;

use App\Models\referensi\ref_jenis_saldo_keluar;
use App\Models\referensi\ref_jenis_saldo_masuk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class saldo extends Model
{
    protected $primaryKey = "saldo_id";

    protected $fillable = [
        'user_id',
        'saldo_keterangan',
        'saldo_status',
        'saldo_jenis',
        'saldo_tgl',
        'saldo_nominal',
        'saldo_total',
        'saldo_kategori'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
    public function jenis_saldo_masuk()
    {
        return $this->hasOne(ref_jenis_saldo_masuk::class, 'jenis_saldo_masuk_id', 'jenis_saldo');
    }

    public function ref_jenis_saldo_keluar()
    {
        return $this->hasOne(ref_jenis_saldo_keluar::class, 'ref_jenis_saldo_keluar_id', 'ref_jenis_saldo_keluar_ids');
    }
}
