<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name', 'details', 'email'];

    public function aspirasis()
    {
        return $this->hasMany(aspirasi::class, 'category_id');
    }
}
