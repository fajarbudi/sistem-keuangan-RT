<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    use HasFactory;

    protected $primaryKey = "pengumuman_id";

    protected $fillable = [
        'pengumuman_judul',
        'pengumuman_tipe',
        'pengumuman_isi',
        'pengumuman_urutan',
        'pengumuman_gambar',
        'pengumuman_pdf',
        'pengumuman_popup',
        'pengumuman_publikasi'
    ];
}
