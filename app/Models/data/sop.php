<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sop extends Model
{
    use HasFactory;

    protected $primaryKey = "sop_id";

    protected $fillable = [
        'sop_judul',
        'sop_isi',
        'sop_urutan',
        'sop_gambar',
        'sop_pdf',
        'sop_popup',
        'sop_publikasi'
    ];
}
