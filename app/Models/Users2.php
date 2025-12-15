<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users2 extends Authenticatable
{
    protected $table = 'users_2';

    protected $fillable = [
        'id_petugas',
        'username',
        'password',
        'role',
        'created_by',
        'level_validator',
    ];

    protected $hidden = ['password'];

    // supaya password otomatis bcrypt
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
