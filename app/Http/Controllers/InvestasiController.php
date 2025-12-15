<?php

namespace App\Http\Controllers;

use App\Models\KabKota;
use App\Models\Investasi;
use Illuminate\Http\Request;
use App\Models\KategoriSektor;
use App\Models\SektorInvestasi;
use App\Exports\InvestasiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapInvestasiTahunanExport;

class InvestasiController extends Controller
{
    public function index_provinsi(Request $request, $kab_kota_id = null)
    {
        $triwulan = $request->input('triwulan', 1);
        $tahun = $request->input('tahun', date('Y'));
        $kategoriFilter = $request->input('kategori');

        $kabkotaList = KabKota::all();
        $nama_kab_kota = null;
        $kategori = collect();

        if ($kab_kota_id) {
            $kabKota = KabKota::find($kab_kota_id);

            if (!$kabKota) {
                abort(404);
            }

            $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($query) use ($kab_kota_id, $triwulan, $tahun) {
                $query->where('kab_kota_id', $kab_kota_id)
                    ->where('triwulan', $triwulan)
                    ->where('tahun', $tahun);
            }]);

            if ($kategoriFilter) {
                $kategori = $kategori->where('nama', $kategoriFilter);
            }

            $kategori = $kategori->get();

            $nama_kab_kota = $kabKota->nama;
        }

        return view('admin-provinsi.data-investasi.view', compact('kategori', 'kabkotaList', 'kab_kota_id', 'nama_kab_kota', 'triwulan', 'tahun', 'kategoriFilter'));
    }

    public function index_kabkota(Request $request)
    {
        $triwulan = $request->input('triwulan', 1);
        $tahun = $request->input('tahun', date('Y'));
        $kategoriFilter = $request->input('kategori');

        $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($query) use ($triwulan, $tahun) {
            $query->where('kab_kota_id', auth('admin')->user()->kab_kota_id)
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun);
        }]);

        if ($kategoriFilter) {
            $kategori = $kategori->where('nama', $kategoriFilter);
        }

        $kategori = $kategori->get();

        $nama_kab_kota = auth('admin')->user()->kabKota->nama;

        $chartData = [];
        foreach ($kategori as $kat) {
            $totalPMA = 0;
            $totalPMDN = 0;

            foreach ($kat->sektorInvestasi as $sektor) {
                foreach ($sektor->investasi as $inv) {
                    $totalPMA += $inv->realisasi_pma ?? 0;
                    $totalPMDN += $inv->realisasi_pmdn ?? 0;
                }
            }

            $chartData[] = [
                'kategori' => $kat->nama,
                'pma' => $totalPMA,
                'pmdn' => $totalPMDN,
            ];
        }

        return view('admin-kabkota.data-investasi.view', compact('kategori', 'nama_kab_kota', 'triwulan', 'tahun', 'kategoriFilter', 'chartData'));
    }

    public function create($triwulan = null, $tahun = null)
    {
        $triwulan = $triwulan ?? 1;
        $tahun = $tahun ?? date('Y');

        $sektor = SektorInvestasi::all();
        $kategori = KategoriSektor::all();

        // Ambil sektor yang sudah ada untuk kab/kota, triwulan & tahun
        $sektorSudahAda = Investasi::where('kab_kota_id', auth('admin')->user()->kab_kota_id)
            ->where('triwulan', $triwulan)
            ->where('tahun', $tahun)
            ->pluck('sektor_investasi_id')
            ->toArray();

        return view('admin-kabkota.data-investasi.tambah', compact(
            'sektor',
            'kategori',
            'triwulan',
            'tahun',
            'sektorSudahAda'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_sektor_id' => 'required',
            'sektor_investasi_id' => 'required',
            'lkpm_pma' => 'required|integer|min:0',
            'realisasi_pma' => ['required', 'regex:/^[0-9.,]+$/'],
            'tki_pma' => 'required|integer|min:0',
            'tka_pma' => 'required|integer|min:0',
            'lkpm_pmdn' => 'required|integer|min:0',
            'realisasi_pmdn' => ['required', 'regex:/^[0-9.,]+$/'],
            'tki_pmdn' => 'required|integer|min:0',
            'tka_pmdn' => 'required|integer|min:0',
            'triwulan' => 'required|integer|min:1|max:4',
            'tahun' => 'required|integer|min:2000',
        ]);

        $kabKotaId = auth('admin')->user()->kab_kota_id;

        // Cek duplikat data sektor pada triwulan & tahun yang sama
        $exists = Investasi::where('kab_kota_id', $kabKotaId)
            ->where('sektor_investasi_id', $request->sektor_investasi_id)
            ->where('triwulan', $request->triwulan)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data Untuk Sektor Ini Pada Triwulan ' . $request->triwulan . ' Tahun ' . $request->tahun . ' Sudah Ada!');
        }

        $realisasi_pma = str_replace(['.', ','], ['', '.'], $request->realisasi_pma);
        $realisasi_pmdn = str_replace(['.', ','], ['', '.'], $request->realisasi_pmdn);

        Investasi::create([
            'kab_kota_id' => $kabKotaId,
            'kategori_sektor_id' => $request->kategori_sektor_id,
            'sektor_investasi_id' => $request->sektor_investasi_id,
            'lkpm_pma' => $request->lkpm_pma,
            'realisasi_pma' => $realisasi_pma,
            'tki_pma' => $request->tki_pma,
            'tka_pma' => $request->tka_pma,
            'lkpm_pmdn' => $request->lkpm_pmdn,
            'realisasi_pmdn' => $realisasi_pmdn,
            'tki_pmdn' => $request->tki_pmdn,
            'tka_pmdn' => $request->tka_pmdn,
            'triwulan' => $request->triwulan,
            'tahun' => $request->tahun,
        ]);

        return redirect()
            ->route('investasi_tampil_kabkota', [
                'triwulan' => $request->triwulan,
                'tahun' => $request->tahun,
            ])
            ->with('success', 'Data Investasi Berhasil diTambahkan!');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id, Request $request)
    {
        $investasi = Investasi::findOrFail($id);
        $kategori  = KategoriSektor::all();
        $sektor    = SektorInvestasi::all();

        $triwulan = $request->query('triwulan', 1);
        $tahun    = $request->query('tahun', date('Y'));

        return view('admin-kabkota.data-investasi.edit', compact(
            'investasi',
            'kategori',
            'sektor',
            'triwulan',
            'tahun'
        ));
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'kategori_sektor_id' => 'required',
            'sektor_investasi_id' => 'required',
            'lkpm_pma' => 'required|integer|min:0',
            'realisasi_pma' => ['required', 'regex:/^[0-9.,]+$/'],
            'tki_pma' => 'required|integer|min:0',
            'tka_pma' => 'required|integer|min:0',
            'lkpm_pmdn' => 'required|integer|min:0',
            'realisasi_pmdn' => ['required', 'regex:/^[0-9.,]+$/'],
            'tki_pmdn' => 'required|integer|min:0',
            'tka_pmdn' => 'required|integer|min:0',
            'triwulan' => 'required|integer|min:1|max:4',
            'tahun' => 'required|integer|min:2000',
        ]);

        $kabKotaId = auth('admin')->user()->kab_kota_id;
        $investasi = Investasi::findOrFail($id);

        // Validasi agar sektor tidak duplikat pada triwulan & tahun yang sama
        $exists = Investasi::where('kab_kota_id', $kabKotaId)
            ->where('sektor_investasi_id', $request->sektor_investasi_id)
            ->where('triwulan', $request->triwulan)
            ->where('tahun', $request->tahun)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data Untuk Sektor Ini Pada Triwulan ' . $request->triwulan . ' Tahun ' . $request->tahun . ' Sudah Ada!');
        }

        // Format angka realisasi
        $realisasi_pma = str_replace(['.', ','], ['', '.'], $request->realisasi_pma);
        $realisasi_pmdn = str_replace(['.', ','], ['', '.'], $request->realisasi_pmdn);

        // Update data investasi
        $investasi->update([
            'kategori_sektor_id'  => $request->kategori_sektor_id,
            'sektor_investasi_id' => $request->sektor_investasi_id,
            'lkpm_pma'            => $request->lkpm_pma,
            'realisasi_pma'       => $realisasi_pma,
            'tki_pma'             => $request->tki_pma,
            'tka_pma'             => $request->tka_pma,
            'lkpm_pmdn'           => $request->lkpm_pmdn,
            'realisasi_pmdn'      => $realisasi_pmdn,
            'tki_pmdn'            => $request->tki_pmdn,
            'tka_pmdn'            => $request->tka_pmdn,
            'triwulan'            => $request->triwulan,
            'tahun'               => $request->tahun,
        ]);

        return redirect()->route('investasi_tampil_kabkota', [
            'triwulan' => $request->triwulan,
            'tahun'    => $request->tahun,
        ])->with('success', 'Data Investasi Berhasil diPerbarui');
    }


    public function destroy(string $id)
    {
        $investasi = Investasi::findOrFail($id);

        // Pastikan hanya admin kab/kota yang sesuai yang boleh hapus
        if ($investasi->kab_kota_id !== auth('admin')->user()->kab_kota_id) {
            abort(403);
        }

        $triwulan = $investasi->triwulan;
        $tahun = $investasi->tahun;

        $investasi->delete();

        return redirect()->route('investasi_tampil_kabkota', [
            'triwulan' => $triwulan,
            'tahun'    => $tahun,
        ])->with('success', 'Data Investasi Berhasil diHapus');
    }

    public function exportExcel(Request $request)
    {
        $triwulan = $request->query('triwulan', 1);
        $tahun = $request->query('tahun', date('Y'));
        $kab_kota_id = $request->query('kab_kota');

        if (auth('admin')->user()->role === 'provinsi') {
            $nama_wilayah = 'Provinsi Sumatera Selatan';

            $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($q) use ($triwulan, $tahun, $kab_kota_id) {
                if ($kab_kota_id) {
                    $q->where('kab_kota_id', $kab_kota_id);
                }
                $q->where('triwulan', $triwulan)
                    ->where('tahun', $tahun);
            }])->get();

            if ($kab_kota_id) {
                $kab = KabKota::find($kab_kota_id);
                if ($kab) {
                    $nama_wilayah = $kab->nama;
                }
            }
        } else {
            $nama_wilayah = auth('admin')->user()->kabKota->nama;
            $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($q) use ($triwulan, $tahun) {
                $q->where('kab_kota_id', auth('admin')->user()->kab_kota_id)
                    ->where('triwulan', $triwulan)
                    ->where('tahun', $tahun);
            }])->get();
        }

        return Excel::download(
            new InvestasiExport($kategori, $nama_wilayah, $triwulan, $tahun),
            "Data-Investasi-{$nama_wilayah}-Triwulan-{$triwulan}-Tahun-{$tahun}.xlsx"
        );
    }

    public function exportRekapInvestasiTahunan(Request $request)
    {
        $tahun = $request->query('tahun', date('Y'));
        $kab_kota_id = $request->query('kab_kota');

        if (auth('admin')->user()->role === 'provinsi') {
            $nama_wilayah = 'Provinsi Sumatera Selatan';

            $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($q) use ($tahun, $kab_kota_id) {
                if ($kab_kota_id) {
                    $q->where('kab_kota_id', $kab_kota_id);
                }
                $q->where('tahun', $tahun);
            }])->get();

            if ($kab_kota_id) {
                $kab = KabKota::find($kab_kota_id);
                if ($kab) {
                    $nama_wilayah = $kab->nama;
                }
            }
        } else {
            $nama_wilayah = auth('admin')->user()->kabKota->nama;
            $kategori = KategoriSektor::with(['sektorInvestasi.investasi' => function ($q) use ($tahun) {
                $q->where('kab_kota_id', auth('admin')->user()->kab_kota_id)
                    ->where('tahun', $tahun);
            }])->get();
        }

        return Excel::download(
            new RekapInvestasiTahunanExport($kategori, $nama_wilayah, $tahun),
            "Data-Investasi-{$nama_wilayah}-Tahun-{$tahun}.xlsx"
        );
    }
}
