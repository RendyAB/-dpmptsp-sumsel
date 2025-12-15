<?php

namespace App\Exports;

use App\Models\Perizinan;
use App\Models\SektorPerizinan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PerizinanKabKotaExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    protected $kabKotaId;
    protected $triwulan;
    protected $tahun;
    protected $namaWilayah;

    public function __construct($kabKotaId, $triwulan, $tahun, $namaWilayah)
    {
        $this->kabKotaId = $kabKotaId;
        $this->triwulan = $triwulan;
        $this->tahun = $tahun;
        $this->namaWilayah = $namaWilayah;
    }

    public function view(): View
    {
        $sektorList = SektorPerizinan::all();

        $data = $sektorList->map(function ($sektor) {
            $oss = Perizinan::where('kab_kota_id', $this->kabKotaId)
                ->where('sektor_perizinan_id', $sektor->id)
                ->where('triwulan', $this->triwulan)
                ->where('tahun', $this->tahun)
                ->where('jenis_input', 'OSS RBA')
                ->sum('jumlah');

            $nonOss = Perizinan::where('kab_kota_id', $this->kabKotaId)
                ->where('sektor_perizinan_id', $sektor->id)
                ->where('triwulan', $this->triwulan)
                ->where('tahun', $this->tahun)
                ->where('jenis_input', 'NON OSS RBA')
                ->sum('jumlah');

            return (object) [
                'sektor' => $sektor->nama,
                'oss_rba' => $oss,
                'non_oss_rba' => $nonOss,
                'total' => $oss + $nonOss,
            ];
        });

        return view('exports.perizinan_kabkota_excel', [
            'perizinan' => $data,
            'nama_wilayah' => $this->namaWilayah,
            'triwulan' => $this->triwulan,
            'tahun' => $this->tahun,
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

                // Header Tabel
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

                // Border seluruh data (dari A6 ke bawah)
                $lastRow = $sheet->getDelegate()->getHighestRow();
                $sheet->getStyle('A7:E' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A21:E21')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'C6EFCE'],
                    ],
                ]);
            }
        ];
    }
}
