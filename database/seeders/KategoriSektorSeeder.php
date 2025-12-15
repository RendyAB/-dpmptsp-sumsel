<?php

namespace Database\Seeders;

use App\Models\KategoriSektor;
use Illuminate\Database\Seeder;

class KategoriSektorSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = ['Sektor Primer', 'Sektor Sekunder', 'Sektor Tersier'];

        foreach ($kategori as $nama) {
            KategoriSektor::create(['nama' => $nama]);
        }
    }
}
