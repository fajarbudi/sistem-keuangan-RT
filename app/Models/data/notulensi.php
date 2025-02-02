<?php

namespace App\Models\data;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class notulensi extends Model
{
    protected $primaryKey = "notulensi_id";

    protected $fillable = [
        'user_id',
        'notulensi_topik',
        'notulensi_kategori'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }
}
