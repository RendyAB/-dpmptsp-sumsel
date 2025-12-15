<?php

namespace Database\Seeders;

use App\Models\SektorPerizinan;
use Illuminate\Database\Seeder;

class SektorPerizinanSeeder extends Seeder
{
    public function run(): void
    {
        $sektor = [
            'ESDM (Energi dan Sumber Daya Mineral',
            'KELAUTAN DAN PERIKANAN',
            'KESEHATAN',
            'KEBUDAYAAN DAN PARIWISATA',
            'PSDA (Pekerjaan Umum dan Perumahan Rakyat',
            'PERDAGANGAN',
            'TRANSPORTASI (PERHUBUNGAN)',
            'PERINDUSTRIAN',
            'PERTANIAN',
            'LINGKUNGAN HIDUP DAN KEHUTANAN',
            'PENDIDIKAN',
            'KETENAGAKERJAAN',
            'KOMUNIKASI DAN INFORMATIKA',
            'SOSIAL'
        ];

        foreach ($sektor as $nama) {
            SektorPerizinan::create(['nama' => $nama]);
        }
    }
}
