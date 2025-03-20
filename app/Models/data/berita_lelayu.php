<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Model;

class berita_lelayu extends Model
{
    protected $primaryKey = "berita_lelayu_id";

    protected $fillable = [
        'berita_lelayu_nama',
        'berita_lelayu_jenis_kelamin',
        'berita_lelayu_umur',
        'berita_lelayu_alamat',
        'berita_lelayu_tgl',
        'berita_lelayu_jam',
        'berita_lelayu_dimakamkan',
        'berita_lelayu_dimakamkan_jam',
        'berita_lelayu_dimakamkan_tempat',
        'berita_lelayu_keluarga'
    ];
}
