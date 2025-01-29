<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Model;

class tentang extends Model
{
    protected $primaryKey = "tentang_id";

    protected $fillable = [
        'tentang_judul',
        'tentang_isi',
        'tentang_publikasi',
        'tentang_urutan'
    ];
}
