<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class aspirasi extends Model
{
    protected $fillable = ['user_id', 'category_id', 'feedback_title', 'details', 'location', 'status', 'image', 'admin_response', 'admin_id'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(\App\Models\Kategori::class, 'category_id');
    }

    public function admin()
    {
        return $this->belongsTo(\App\Models\User::class, 'admin_id');
    }

}
