<?php

namespace App\Http\Controllers\PTSP\Rekap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perizinan2;
use App\Models\KabKota;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapPerizinanExportController extends Controller
{

    public function index(Request $req)
    {
        // Paging
        $perPage = $req->input('per_page', 20);
        $perPage = $perPage <= 0 ? 20 : $perPage;

        $triwulan = trim($req->triwulan ?? '');
        $tahun = trim($req->tahun ?? date('Y'));
        $kabkot = trim($req->kabkot ?? '');
        $search = trim($req->search ?? '');

        // Filter tanggal
        $filter_date = $req->filter_date ?? 'tgl_pmh';
        if (!in_array($filter_date, ['tgl_pmh', 'tgl_terbit'])) {
            $filter_date = 'tgl_pmh';
        }

        // ============================
        // QUERY AWAL → Hanya yang disetujui Kabid
        // ============================
        $query = Perizinan2::query()
            ->where('status', 'disetujui_kabid');

        // Filter Triwulan
        if ($triwulan !== '') {
            switch ($triwulan) {
                case '1':
                    $start = "$tahun-01-01";
                    $end = "$tahun-03-31";
                    break;
                case '2':
                    $start = "$tahun-04-01";
                    $end = "$tahun-06-30";
                    break;
                case '3':
                    $start = "$tahun-07-01";
                    $end = "$tahun-09-30";
                    break;
                case '4':
                    $start = "$tahun-10-01";
                    $end = "$tahun-12-31";
                    break;
                default:
                    $start = "$tahun-01-01";
                    $end = "$tahun-12-31";
                    break;
            }

            $query->whereBetween($filter_date, [$start, $end]);
        } else {
            // Filter tahun
            $query->whereBetween($filter_date, [
                "$tahun-01-01",
                "$tahun-12-31"
            ]);
        }

        // Filter Kab/Kota
        if ($kabkot !== '') {
            $query->where('kab', $kabkot);
        }

        // Search Global
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('no_pmh', 'like', "%$search%")
                    ->orWhere('nama_pers', 'like', "%$search%")
                    ->orWhere('nib', 'like', "%$search%");
            });
        }

        // Order by
        $query->orderBy($filter_date, 'DESC')
            ->orderBy('no_pmh', 'DESC');

        // Pagination
        $perizinan = $query->paginate($perPage)->withQueryString();

        // List kabkot untuk dropdown
        $kabkotList = KabKota::select('nama')->distinct()->orderBy('nama')->get();

        // Link export PDF/Excel
        $exportPdf = route('rekap.perizinan.export', array_merge($req->query(), ['format' => 'pdf']));
        $exportExcel = route('rekap.perizinan.export', array_merge($req->query(), ['format' => 'excel']));

        return view('ptsp.rekap.perizinan', compact(
            'perizinan',
            'kabkotList',
            'filter_date',
            'triwulan',
            'tahun',
            'kabkot',
            'search',
            'exportPdf',
            'exportExcel'
        ));
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'pdf');

        // ---------------------- Ambil filter ----------------------
        $triwulan = $request->get('triwulan');
        $tahun = $request->get('tahun', date('Y'));
        $kabkot = $request->get('kabkot');
        $search = $request->get('search');
        $filter_date = $request->get('filter_date', 'tgl_pmh');

        if (!in_array($filter_date, ['tgl_pmh', 'tgl_terbit'])) {
            $filter_date = 'tgl_pmh';
        }

        // ---------------------- Build query ----------------------
        $query = Perizinan2::query();

        // Filter triwulan
        if ($triwulan !== null && $triwulan !== '') {
            switch ($triwulan) {
                case '1':
                    $start = "$tahun-01-01";
                    $end = "$tahun-03-31";
                    break;
                case '2':
                    $start = "$tahun-04-01";
                    $end = "$tahun-06-30";
                    break;
                case '3':
                    $start = "$tahun-07-01";
                    $end = "$tahun-09-30";
                    break;
                case '4':
                    $start = "$tahun-10-01";
                    $end = "$tahun-12-31";
                    break;
                case 'all':
                    $start = "$tahun-01-01";
                    $end = "$tahun-12-31";
                    break;
                default:
                    $start = $end = null;
            }

            if ($start && $end) {
                $query->whereBetween($filter_date, [$start, $end]);
            }
        } else {
            // Filter tahun saja
            $query->whereBetween($filter_date, [
                "$tahun-01-01",
                "$tahun-12-31"
            ]);
        }

        // Filter kabkot
        if (!empty($kabkot)) {
            $query->where('kab', $kabkot);
        }

        // Search global
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('no_pmh', 'like', "%$search%")
                    ->orWhere('nama_pers', 'like', "%$search%")
                    ->orWhere('nib', 'like', "%$search%");
            });
        }

        $data = $query->orderBy($filter_date, 'DESC')->orderBy('no_pmh', 'DESC')->get();

        // ---------------------- EXPORT PDF ----------------------
        if ($format === 'pdf') {
            $html = view('ptsp.rekap.perizinan.export_pdf', [
                'data' => $data,
                'filter_date' => $filter_date
            ])->render();

            $dompdf = new Dompdf(['isRemoteEnabled' => true]);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            return response($dompdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="rekap_perizinan.pdf"');
        }

        // ---------------------- EXPORT EXCEL ----------------------
        if ($format === 'excel') {

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("Rekap Perizinan");

            // Header Excel
            $sheet->setCellValue('A1', 'No');
            $sheet->setCellValue('B1', 'No Permohonan');
            $sheet->setCellValue('C1', 'Nama Perusahaan');
            $sheet->setCellValue('D1', 'Jenis Permohonan');
            $sheet->setCellValue('E1', $filter_date === 'tgl_terbit' ? 'Tanggal Terbit' : 'Tanggal Permohonan');
            $sheet->setCellValue('F1', 'Kabupaten/Kota');
            $sheet->setCellValue('G1', 'Status');

            // Isi data
            $row = 2;
            $no = 1;

            foreach ($data as $d) {
                $sheet->setCellValue("A$row", $no++);
                $sheet->setCellValue("B$row", $d->no_pmh);
                $sheet->setCellValue("C$row", $d->nama_pers);
                $sheet->setCellValue("D$row", $d->jenis_pmh);
                $sheet->setCellValue("E$row", $d->{$filter_date});
                $sheet->setCellValue("F$row", $d->kab);
                $sheet->setCellValue("G$row", $d->status);

                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $fileName = "rekap_perizinan.xlsx";
            $filePath = public_path($fileName);
            $writer->save($filePath);

            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        return abort(400, "Format export tidak valid");
    }
}
