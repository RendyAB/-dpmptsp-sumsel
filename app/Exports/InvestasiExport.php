<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class InvestasiExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    protected $kategori;
    protected $nama_wilayah;
    protected $triwulan;
    protected $tahun;

    public function __construct($kategori, $nama_wilayah, $triwulan, $tahun)
    {
        $this->kategori = $kategori;
        $this->nama_wilayah = $nama_wilayah;
        $this->triwulan = $triwulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        return view('exports.investasi_excel', [
            'kategori' => $this->kategori,
            'nama_wilayah' => $this->nama_wilayah,
            'triwulan' => $this->triwulan,
            'tahun' => $this->tahun,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 33,
            'C' => 7,
            'D' => 17,
            'E' => 7,
            'F' => 7,
            'G' => 7,
            'H' => 17,
            'I' => 7,
            'J' => 7,
            'K' => 7,
            'L' => 17,
            'M' => 7,
            'N' => 7,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1. Judul Utama
                $sheet->mergeCells('A1:N1');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A:A')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->mergeCells('A2:N2');
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A:A')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->mergeCells('A3:N3');
                $sheet->getStyle('A3')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A:A')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // 2. Header Tabel
                $sheet->getStyle('A5:N5')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ]
                    ]
                ]);


                $sheet->getStyle('A6:N6')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ]
                    ]
                ]);

                // 3. Kolom PMA (warna kuning muda)
                $sheet->getStyle('C5:F5')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ]
                ]);

                $sheet->getStyle('C7:F11')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF2CC'],
                    ]
                ]);
                $sheet->getStyle('C13:F24')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF2CC'],
                    ]
                ]);
                $sheet->getStyle('C26:F33')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF2CC'],
                    ]
                ]);

                // 4. Kolom PMDN (warna biru muda)
                $sheet->getStyle('K7:N11')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2'],
                    ]
                ]);
                $sheet->getStyle('K13:N24')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2'],
                    ]
                ]);
                $sheet->getStyle('K26:N33')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2'],
                    ]
                ]);

                $sheet->getStyle('A12:N12')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ]
                ]);
                $sheet->getStyle('A25:N25')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ]
                ]);
                $sheet->getStyle('A34:N34')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E8EBEA'],
                    ]
                ]);

                // 5. Total Keseluruhan Bold + Warna
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle("A{$highestRow}:N{$highestRow}")->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'C6EFCE'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ]
                    ]
                ]);

                // 6. Border semua data
                $sheet->getStyle("A5:N{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ]
                    ]
                ]);

                $sheet->getStyle('C8:N' . $highestRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
                $sheet->getStyle("A5:N{$highestRow}")->getFont()->setSize(8);
                $sheet->getStyle('B:B')->getAlignment()->setWrapText(true);
            },
        ];
    }
}
