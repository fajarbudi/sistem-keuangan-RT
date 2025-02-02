<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Model;

class notulensi_data extends Model
{
    protected $primaryKey = "notulensi_data_id";

    protected $fillable = [
        'notulensi_id',
        'pertemuan_id',
        'notulensi_isi'
    ];

    public function pertemuan()
    {
        return $this->hasOne(pertemuan::class, 'pertemuan_id', 'pertemuan_id');
    }
}
