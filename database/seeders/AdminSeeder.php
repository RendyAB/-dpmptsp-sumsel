<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\KabKota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        //Kab/Kota
        KabKota::insert([
            ['nama' => 'Kota Palembang'],
            ['nama' => 'Kota Pagar Alam'],
            ['nama' => 'Kota Lubuk Linggau'],
            ['nama' => 'Kota Prabumulih'],
            ['nama' => 'Kabupaten Banyuasin'],
            ['nama' => 'Kabupaten Empat Lawang'],
            ['nama' => 'Kabupaten Lahat'],
            ['nama' => 'Kabupaten Muara Enim'],
            ['nama' => 'Kabupaten Musi Banyuasin'],
            ['nama' => 'Kabupaten Musi Rawas'],
            ['nama' => 'Kabupaten Musi Rawas Utara'],
            ['nama' => 'Kabupaten Ogan Ilir'],
            ['nama' => 'Kabupaten Ogan Komering Ilir'],
            ['nama' => 'Kabupaten Ogan Komering Ulu'],
            ['nama' => 'Kabupaten Ogan Komering Ulu Selatan'],
            ['nama' => 'Kabupaten Ogan Komering Ulu Timur'],
            ['nama' => 'Kabupaten Penukal Abab Lematang Ilir'],
        ]);

        //Admin Provinsi
        Admin::create([
            'username' => 'admin-sumsel@gmail.com',
            'password' => Hash::make('sumsel321'),
            'role' => 'provinsi',
            'kab_kota_id' => null,
        ]);

        //Ambil ID kab/kota berdasarkan nama
        $palembang = KabKota::where('nama', 'Kota Palembang')->first();
        $pagaralam = KabKota::where('nama', 'Kota Pagar Alam')->first();
        $lubuklinggau = KabKota::where('nama', 'Kota Lubuk Linggau')->first();
        $prabumulih = KabKota::where('nama', 'Kota Prabumulih')->first();
        $banyuasin = KabKota::where('nama', 'Kabupaten Banyuasin')->first();
        $empatlawang = KabKota::where('nama', 'Kabupaten Empat Lawang')->first();
        $lahat = KabKota::where('nama', 'Kabupaten Lahat')->first();
        $muaraenim = KabKota::where('nama', 'Kabupaten Muara Enim')->first();
        $musibanyuasin = KabKota::where('nama', 'Kabupaten Musi Banyuasin')->first();
        $musirawas = KabKota::where('nama', 'Kabupaten Musi Rawas')->first();
        $musirawasutara = KabKota::where('nama', 'Kabupaten Musi Rawas Utara')->first();
        $oganilir = KabKota::where('nama', 'Kabupaten Ogan Ilir')->first();
        $ogankomeringilir = KabKota::where('nama', 'Kabupaten Ogan Komering Ilir')->first();
        $ogankomeringulu = KabKota::where('nama', 'Kabupaten Ogan Komering Ulu')->first();
        $ogankomeringuluselatan = KabKota::where('nama', 'Kabupaten Ogan Komering Ulu Selatan')->first();
        $ogankomeringulutimur = KabKota::where('nama', 'Kabupaten Ogan Komering Ulu Timur')->first();
        $penukalabablematangilir = KabKota::where('nama', 'Kabupaten Penukal Abab Lematang Ilir')->first();

        //Admin Kab/Kota

        if ($palembang) {
            Admin::create([
                'username' => 'admin-palembang@gmail.com',
                'password' => Hash::make('palembang321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $palembang->id,
            ]);
        }
        if ($pagaralam) {
            Admin::create([
                'username' => 'admin-pagaralam@gmail.com',
                'password' => Hash::make('pagaralam321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $pagaralam->id,
            ]);
        }
        if ($lubuklinggau) {
            Admin::create([
                'username' => 'admin-lubuklinggau@gmail.com',
                'password' => Hash::make('lubuklinggau321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $lubuklinggau->id,
            ]);
        }
        if ($prabumulih) {
            Admin::create([
                'username' => 'admin-prabumulih@gmail.com',
                'password' => Hash::make('prabumulih321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $prabumulih->id,
            ]);
        }
        if ($banyuasin) {
            Admin::create([
                'username' => 'admin-banyuasin@gmail.com',
                'password' => Hash::make('banyuasin321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $banyuasin->id,
            ]);
        }
        if ($empatlawang) {
            Admin::create([
                'username' => 'admin-empatlawang@gmail.com',
                'password' => Hash::make('empatlawang321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $empatlawang->id,
            ]);
        }
        if ($lahat) {
            Admin::create([
                'username' => 'admin-lahat@gmail.com',
                'password' => Hash::make('lahat321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $lahat->id,
            ]);
        }
        if ($muaraenim) {
            Admin::create([
                'username' => 'admin-muaraenim@gmail.com',
                'password' => Hash::make('muaraenim321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $muaraenim->id,
            ]);
        }
        if ($musibanyuasin) {
            Admin::create([
                'username' => 'admin-muba@gmail.com',
                'password' => Hash::make('muba321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $musibanyuasin->id,
            ]);
        }
        if ($musirawas) {
            Admin::create([
                'username' => 'admin-musirawas@gmail.com',
                'password' => Hash::make('musirawas321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $musirawas->id,
            ]);
        }
        if ($musirawasutara) {
            Admin::create([
                'username' => 'admin-muratara@gmail.com',
                'password' => Hash::make('muratara321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $musirawasutara->id,
            ]);
        }
        if ($oganilir) {
            Admin::create([
                'username' => 'admin-oganilir@gmail.com',
                'password' => Hash::make('oganilir321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $oganilir->id,
            ]);
        }
        if ($ogankomeringilir) {
            Admin::create([
                'username' => 'admin-oki@gmail.com',
                'password' => Hash::make('oki321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $ogankomeringilir->id,
            ]);
        }
        if ($ogankomeringulu) {
            Admin::create([
                'username' => 'admin-oku@gmail.com',
                'password' => Hash::make('oku321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $ogankomeringulu->id,
            ]);
        }
        if ($ogankomeringuluselatan) {
            Admin::create([
                'username' => 'admin-okuselatan@gmail.com',
                'password' => Hash::make('okuselatan321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $ogankomeringuluselatan->id,
            ]);
        }
        if ($ogankomeringulutimur) {
            Admin::create([
                'username' => 'admin-okutimur@gmail.com',
                'password' => Hash::make('okutimur321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $ogankomeringulutimur->id,
            ]);
        }
        if ($penukalabablematangilir) {
            Admin::create([
                'username' => 'admin-pali@gmail.com',
                'password' => Hash::make('pali321'),
                'role' => 'kab_kota',
                'kab_kota_id' => $penukalabablematangilir->id,
            ]);
        }
    }
}
