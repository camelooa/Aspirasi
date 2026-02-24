<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['name', 'details', 'email', 'penanggung_jawab_id'];

    public function aspirasis()
    {
        return $this->hasMany(aspirasi::class, 'category_id');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(PenanggungJawab::class, 'penanggung_jawab_id');
    }
}
