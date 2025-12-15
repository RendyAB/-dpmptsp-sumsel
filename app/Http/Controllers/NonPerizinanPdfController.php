<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonPerizinan;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;

class NonPerizinanPdfController extends Controller
{
    /**
     * Load tanda tangan sebagai Base64
     */
    private function loadTTD($filename)
    {
        $path = public_path('assets/' . $filename);

        if (!file_exists($path)) {
            return null;
        }

        $mime = mime_content_type($path);
        $base64 = base64_encode(file_get_contents($path));

        return "data:$mime;base64,$base64";
    }

    private $fields = [
        'kepada',
        'perihal',
        'tanggal_proses',
        'petugas',
        'nip',
        'jabatan',
        'no_pmh',
        'no_keg',
        'tgl_pmh',
        'jenis_pmh',
        'nama_pers',
        'jenis_pers',
        'jenis_keg',
        'nib',
        'npwp',
        'sektor',
        'luas',
        'skala',
        'risiko',
        'kbli',
        'nama_izin',
        'pj_pers',
        'alamat',
        'kab',
        'no_telp',
        'email',
        'modal',
        'dokumen',
        'jumlah_dok',
        'jenis_dok',
        'no_verif',
        'tgl_verif',
        'dok_verif',
        'status',
        'catatan',
        'tgl_terbit',
        'ket_status'
    ];

    public function generate(Request $request)
    {
        $idToFetch = null;
        $data = [];

        // --------------------------------------
        // 1. POST → Insert data baru
        // --------------------------------------
        if ($request->isMethod('POST')) {

            $jenisDokumen = '';
            if ($request->hasFile('jenis_dok')) {
                $file = $request->file('jenis_dok');
                $filename = time() . '_jenis_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads/non_perizinan', $filename);
                $jenisDokumen = $filename;
            }

            $dokVerif = '';
            if ($request->hasFile('dok_verif')) {
                $file = $request->file('dok_verif');
                $filename = time() . '_verif_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads/non_perizinan', $filename);
                $dokVerif = $filename;
            }

            foreach ($this->fields as $f) {
                if ($f === 'jenis_dok' || $f === 'dok_verif')
                    continue;
                $data[$f] = $request->input($f, '');
            }

            $data['jenis_dok'] = $jenisDokumen;
            $data['dok_verif'] = $dokVerif;

            if (empty($data['status']))
                $data['status'] = 'menunggu';
            if (empty($data['tgl_terbit']))
                $data['tgl_terbit'] = null;

            $insert = NonPerizinan::create($data);
            $idToFetch = $insert->id;
        }

        // --------------------------------------
        // 2. GET → Ambil data berdasarkan ID
        // --------------------------------------
        else {
            $idToFetch = $request->query('id');
        }

        if (!$idToFetch) {
            return "No data to generate PDF. Provide POST data or ?id=...";
        }

        $nonPerizinan = NonPerizinan::find($idToFetch);

        if (!$nonPerizinan) {
            return "Record not found for id=" . $idToFetch;
        }

        // --------------------------------------
        // 3. Load TTD
        // --------------------------------------
        $logo_base64 = $this->loadTTD('logo.png');
        $ttd1_base64 = $this->loadTTD('ttd1.png');
        $ttd2_base64 = $this->loadTTD('ttd2.png');
        $ttd3_base64 = $this->loadTTD('ttd3.png');
        $ttd4_base64 = $this->loadTTD('ttd4.png');

        // --------------------------------------
        // 4. Render VIEW
        // --------------------------------------
        $html = view('ptsp.pdf.non_perizinan_status', [
            'data' => $nonPerizinan,
            'logo_base64' => $logo_base64,
            'ttd1_base64' => $ttd1_base64,
            'ttd2_base64' => $ttd2_base64,
            'ttd3_base64' => $ttd3_base64,
            'ttd4_base64' => $ttd4_base64,
        ])->render();

        // --------------------------------------
        // 5. Generate PDF
        // --------------------------------------
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // --------------------------------------
        // 6. Save PDF
        // --------------------------------------
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $nonPerizinan->nama_pers ?? 'TanpaNama');
        $filename = 'surat_non_perizinan_' . $safeName . '_' . date('Ymd_His') . '.pdf';

        Storage::disk('public')->makeDirectory('surat/non_perizinan');
        Storage::disk('public')->put('surat/non_perizinan/' . $filename, $dompdf->output());

        $nonPerizinan->update(['pdf_file' => $filename]);

        // --------------------------------------
        // 7. Stream PDF
        // --------------------------------------
        return $dompdf->stream($filename, ["Attachment" => false]);
    }
}
