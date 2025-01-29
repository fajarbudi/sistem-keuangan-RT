<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peraturan extends Model
{
    use HasFactory;

    protected $primaryKey = "peraturan_id";

    protected $fillable = [
        'peraturan_judul',
        'peraturan_isi',
        'peraturan_urutan',
        'peraturan_gambar',
        'peraturan_pdf',
        'peraturan_popup',
        'peraturan_publikasi'
    ];
}
