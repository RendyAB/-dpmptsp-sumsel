<?php

namespace App\Http\Controllers;

use App\Models\Perizinan2;
use App\Models\Validasi;
use App\Models\ValidasiLog;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

class PerizinanExportController extends Controller
{
    public function exportStatus($id)
    {
        $perizinan = Perizinan2::findOrFail($id);

        // Ambil validasi + log terbaru
        $validasi = Validasi::where('perizinan_id', $id)->first();
        $log = $validasi ? $validasi->latestLog : null;

        // Pilihan format
        $format = request()->get('format', 'pdf'); // default PDF

        if ($format === 'excel') {
            return $this->exportExcel($perizinan, $log);
        }

        return $this->exportPdf($perizinan, $log);
    }

    // ============================
    //  EXPORT PDF
    // ============================
    private function exportPdf($perizinan, $log)
    {
        $html = view('ptsp.pdf.perizinan_status', compact('perizinan', 'log'))->render();

        $dompdf = new Dompdf(['isRemoteEnabled' => true]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('status_perizinan.pdf', [
            'Attachment' => true
        ]);
    }

    // ============================
    //  EXPORT EXCEL
    // ============================
    private function exportExcel($perizinan, $log)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Field');
        $sheet->setCellValue('B1', 'Value');

        $data = [
            'Nama Perusahaan' => $perizinan->nama_pers,
            'Nomor Permohonan' => $perizinan->no_pmh,
            'Status' => $perizinan->status,
            'Catatan Verifikator' => $log->catatan ?? '-',
        ];

        $row = 2;
        foreach ($data as $key => $value) {
            $sheet->setCellValue('A' . $row, $key);
            $sheet->setCellValue('B' . $row, $value);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'status_perizinan.xlsx';

        // Output
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }
}
