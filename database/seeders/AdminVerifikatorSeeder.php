<?php

namespace Database\Seeders;

use App\Models\AdminVerifikator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminVerifikatorSeeder extends Seeder
{
    public function run(): void
    {
        AdminVerifikator::create([
            'username' => 'superadmin@gmail.com',
            'password' => Hash::make('super123'),
            'role' => 'super_admin',
            'nama_petugas' => 'Super Admin',
            'nip' => '000000000',
        ]);

        AdminVerifikator::create([
            'username' => 'petugas@gmail.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'nama_petugas' => 'Petugas',
            'nip' => '000001111',
        ]);

        AdminVerifikator::create([
            'username' => 'madya1@gmail.com',
            'password' => Hash::make('madya123'),
            'role' => 'madya_1',
            'nama_petugas' => 'Madya One',
            'nip' => '111111111',
        ]);

        AdminVerifikator::create([
            'username' => 'madya2@gmail.com',
            'password' => Hash::make('madya123'),
            'role' => 'madya_2',
            'nama_petugas' => 'Madya Two',
            'nip' => '222222222',
        ]);

        AdminVerifikator::create([
            'username' => 'madya3@gmail.com',
            'password' => Hash::make('madya123'),
            'role' => 'madya_3',
            'nama_petugas' => 'Madya Three',
            'nip' => '333333333',
        ]);

        AdminVerifikator::create([
            'username' => 'kabid@gmail.com',
            'password' => Hash::make('kabid123'),
            'role' => 'kabid',
            'nama_petugas' => 'Kabid',
            'nip' => '444444444',
        ]);
    }
}

