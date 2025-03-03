<?php

namespace App\Models\referensi;

use Illuminate\Database\Eloquent\Model;

class ref_jenis_uang extends Model
{
    protected $primaryKey = "jenis_uang_id";

    protected $fillable = [
        'jenis_uang_nama',
        'jenis_uang_kategori'
    ];
}
