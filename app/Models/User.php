<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'full_name',
        'roles',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // tell Laravel login uses username
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
