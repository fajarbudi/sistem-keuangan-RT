<?php

namespace App\Models\referensi;

use Illuminate\Database\Eloquent\Model;

class ref_nominal extends Model
{
    protected $primaryKey = "nominal_masuk_id";

    protected $fillable = [
        'nominal_nominal',
        'nominal_kategori'
    ];
}
