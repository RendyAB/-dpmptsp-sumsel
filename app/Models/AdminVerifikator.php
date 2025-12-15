<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminVerifikator extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_verifikator';

    protected $fillable = [
        'username',
        'password',
        'role',
        'nama_petugas',
        'nip',
    ];

    protected $hidden = ['password'];

    public static function roleLevel($role)
    {
        return [
            'petugas' => 0,
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4,
        ][$role] ?? 0;
    }
}
