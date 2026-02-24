<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenanggungJawab extends Model
{
    protected $table = 'penanggung_jawabs';
    protected $fillable = ['nama', 'email', 'jabatan'];

    public function kategoris()
    {
        return $this->hasMany(Kategori::class, 'penanggung_jawab_id');
    }
}
