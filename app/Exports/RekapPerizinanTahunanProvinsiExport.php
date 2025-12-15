<?php

namespace App\Exports;

use App\Models\Perizinan;
use App\Models\KabKota;
use App\Models\SektorPerizinan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class RekapPerizinanTahunanProvinsiExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    protected $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        // Data per kabupaten/kota
        $kabkotaData = KabKota::all()->map(function ($kabkota) {
            $ossRba = Perizinan::where('kab_kota_id', $kabkota->id)
                ->where('jenis_input', 'OSS RBA')
                ->where('tahun', $this->tahun)
                ->sum('jumlah');

            $nonOssRba = Perizinan::where('kab_kota_id', $kabkota->id)
                ->where('jenis_input', 'NON OSS RBA')
                ->where('tahun', $this->tahun)
                ->sum('jumlah');

            return (object) [
                'nama_kab_kota' => $kabkota->nama,
                'oss_rba' => $ossRba,
                'non_oss_rba' => $nonOssRba,
                'total' => $ossRba + $nonOssRba,
            ];
        });

        // Data per sektor
        $sektorData = SektorPerizinan::all()->map(function ($sektor) {
            $ossRba = Perizinan::where('sektor_perizinan_id', $sektor->id)
                ->where('jenis_input', 'OSS RBA')
                ->where('tahun', $this->tahun)
                ->sum('jumlah');

            $nonOssRba = Perizinan::where('sektor_perizinan_id', $sektor->id)
                ->where('jenis_input', 'NON OSS RBA')
                ->where('tahun', $this->tahun)
                ->sum('jumlah');

            return (object) [
                'nama_sektor' => $sektor->nama,
                'oss_rba' => $ossRba,
                'non_oss_rba' => $nonOssRba,
                'total' => $ossRba + $nonOssRba,
            ];
        });

        return view('exports.rekap_perizinan_tahunan_provinsi', [
            'tahun' => $this->tahun,
            'kabkotaData' => $kabkotaData,
            'sektorData' => $sektorData,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 60,
            'C' => 25,
            'D' => 30,
            'E' => 30,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Judul Utama
                $sheet->mergeCells('A1:E1');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->mergeCells('A2:E2');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $sheet->mergeCells('A3:E3');
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $headerRange = 'A5:E6';
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ],
                ]);

                $sheet->getStyle('A24:E24')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'C6EFCE'],
                    ],
                ]);

                $headerRange = 'A26:E27';
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ],
                ]);

                $sheet->getStyle('A42:E42')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'C6EFCE'],
                    ],
                ]);

                $lastRow = $sheet->getDelegate()->getHighestRow();
                $sheet->getStyle('A5:E' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $sheet->getStyle('A25:E25')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_NONE,
                        ],
                    ],
                ]);
            },
        ];
    }
}
