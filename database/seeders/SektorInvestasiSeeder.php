<?php

namespace Database\Seeders;

use App\Models\KategoriSektor;
use App\Models\SektorInvestasi;
use Illuminate\Database\Seeder;

class SektorInvestasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Sektor Primer' => [
                'Pertambangan',
                'Kehutanan',
                'Tanaman Pangan, Perkebunan, Peternakan',
                'Perikanan'
            ],
            'Sektor Sekunder' => [
                'Industri Karet dan Plastik',
                'Industri Kayu',
                'Industri Kertas dan Percetakan',
                'Industri Kimia dan Farmasi',
                'Industri Makanan',
                'Industri Mesin, Elektronik, Instrumen Kedokteran, Peralatan Listrik, Presisi, Optik dan Jam',
                'Industri Mineral non Logam',
                'Industri Logam Dasar, Barang Logam, Bukan Mesin dan Peralatannya',
                'Industri Kendaraan Bermotor dan Alat Transportasi Lain',
                'Industri Lainnya',
                'Industri Tekstil'
            ],
            'Sektor Tersier' => [
                'Hotel dan Restoran',
                'Konstruksi',
                'Listrik, Gas dan Air',
                'Perdagangan dan Reparasi',
                'Perumahan, Kawasan Industri dan Perkantoran',
                'Transportasi, Gudang dan Telekomunikasi',
                'Jasa Lainnya'
            ]
        ];

        foreach ($data as $kategori => $subsektors) {
            $kategoriModel = KategoriSektor::firstOrCreate(['nama' => $kategori]);

            foreach ($subsektors as $namaSub) {
                SektorInvestasi::create([
                    'kategori_sektor_id' => $kategoriModel->id,
                    'nama' => $namaSub,
                ]);
            }
        }
    }
}
