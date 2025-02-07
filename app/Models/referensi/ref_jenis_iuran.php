<?php

namespace App\Models\referensi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ref_jenis_iuran extends Model
{
    protected $primaryKey = "jenis_iuran_id";

    protected $fillable = [
        'jenis_iuran_nama',
        'jenis_iuran_kategori',
        'penanggung_jawab'
    ];

    public function penanggungJawab()
    {
        return $this->hasOne(User::class, 'user_id', 'penanggung_jawab');
    }
}
