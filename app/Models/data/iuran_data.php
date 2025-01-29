<?php

namespace App\Models\data;

use Illuminate\Database\Eloquent\Model;

class iuran_data extends Model
{
    protected $primaryKey = "iuran_data_id";

    protected $fillable = [
        'iuran_id',
        'user_id',
        'iuran_data_nominal'
    ];
}
