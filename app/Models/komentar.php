<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $fillable = ['aspirasi_id', 'user_id', 'komentar'];

    public function aspirasi()
    {
        return $this->belongsTo(\App\Models\aspirasi::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
