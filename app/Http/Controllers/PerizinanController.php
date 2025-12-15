<?php

namespace App\Http\Controllers;

use App\Models\KabKota;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use App\Models\SektorPerizinan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PerizinanProvinsiExport;
use App\Exports\PerizinanKabKotaExport;
use App\Exports\RekapPerizinanTahunanKabKotaExport;
use App\Exports\RekapPerizinanTahunanProvinsiExport;

class PerizinanController extends Controller
{
    // TAMPILAN ADMIN PROVINSI
    public function index_provinsi(Request $request)
    {
        $triwulan = $request->get('triwulan', 1);
        $tahun = $request->get('tahun', date('Y'));

        // Data per kabupaten/kota
        $kabkota = KabKota::all();
        $kabkotaData = $kabkota->map(function ($k) use ($triwulan, $tahun) {
            $oss = Perizinan::where('kab_kota_id', $k->id)
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->where('jenis_input', 'OSS RBA')
                ->sum('jumlah');

            $nonOss = Perizinan::where('kab_kota_id', $k->id)
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->where('jenis_input', 'NON OSS RBA')
                ->sum('jumlah');

            return (object) [
                'nama_kab_kota' => $k->nama,
                'oss_rba' => $oss,
                'non_oss_rba' => $nonOss,
                'total' => $oss + $nonOss
            ];
        });

        // Data per sektor
        $sektor = SektorPerizinan::all();
        $sektorData = $sektor->map(function ($s) use ($triwulan, $tahun) {
            $oss = Perizinan::where('sektor_perizinan_id', $s->id)
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->where('jenis_input', 'OSS RBA')
                ->sum('jumlah');

            $nonOss = Perizinan::where('sektor_perizinan_id', $s->id)
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->where('jenis_input', 'NON OSS RBA')
                ->sum('jumlah');

            return (object) [
                'nama_sektor' => $s->nama,
                'oss_rba' => $oss,
                'non_oss_rba' => $nonOss,
                'total' => $oss + $nonOss
            ];
        });

        return view('admin-provinsi.data-perizinan.view', compact('kabkotaData', 'sektorData', 'triwulan', 'tahun'));
    }

    // TAMPILAN ADMIN KAB/KOTA
    public function index_kabkota(Request $request)
    {
        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;
        $nama_kab_kota = auth()->guard('admin')->user()->kabKota->nama;
        $triwulan = $request->get('triwulan', 1);
        $tahun = $request->get('tahun', date('Y'));

        $sektor = SektorPerizinan::all();

        $perizinan = $sektor->map(function ($s) use ($kabKotaId, $triwulan, $tahun) {
            $oss = Perizinan::where('kab_kota_id', $kabKotaId)
                ->where('sektor_perizinan_id', $s->id)
                ->where('jenis_input', 'OSS RBA')
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->sum('jumlah');

            $nonOss = Perizinan::where('kab_kota_id', $kabKotaId)
                ->where('sektor_perizinan_id', $s->id)
                ->where('jenis_input', 'NON OSS RBA')
                ->where('triwulan', $triwulan)
                ->where('tahun', $tahun)
                ->sum('jumlah');

            return (object) [
                'sektor_id' => $s->id,
                'sektor' => $s->nama,
                'oss_rba' => $oss,
                'non_oss_rba' => $nonOss,
                'total' => $oss + $nonOss
            ];
        });

        return view('admin-kabkota.data-perizinan.view', compact('perizinan', 'triwulan', 'tahun', 'nama_kab_kota'));
    }

    public function create(Request $request)
    {
        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;
        $triwulan = $request->get('triwulan', 1);
        $tahun = $request->get('tahun', date('Y'));

        // Ambil sektor yang BELUM diinput pada triwulan & tahun ini
        $inputtedSektorIds = Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('triwulan', $triwulan)
            ->where('tahun', $tahun)
            ->pluck('sektor_perizinan_id')
            ->toArray();

        $sektor = SektorPerizinan::whereNotIn('id', $inputtedSektorIds)->get();

        return view('admin-kabkota.data-perizinan.tambah', compact('sektor', 'triwulan', 'tahun'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'sektor_perizinan_id' => 'required|exists:sektor_perizinan,id',
            'oss_rba' => 'required|integer|min:0',
            'non_oss_rba' => 'required|integer|min:0',
            'triwulan' => 'required|integer|min:1|max:4',
            'tahun' => 'required|integer|min:2000',
        ]);

        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;

        // Simpan data OSS RBA
        if ($request->oss_rba > 0) {
            Perizinan::create([
                'kab_kota_id' => $kabKotaId,
                'sektor_perizinan_id' => $request->sektor_perizinan_id,
                'jenis_input' => 'OSS RBA',
                'jumlah' => $request->oss_rba,
                'triwulan' => $request->triwulan,
                'tahun' => $request->tahun,
            ]);
        }

        // Simpan data NON OSS RBA
        if ($request->non_oss_rba > 0) {
            Perizinan::create([
                'kab_kota_id' => $kabKotaId,
                'sektor_perizinan_id' => $request->sektor_perizinan_id,
                'jenis_input' => 'NON OSS RBA',
                'jumlah' => $request->non_oss_rba,
                'triwulan' => $request->triwulan,
                'tahun' => $request->tahun,
            ]);
        }

        return redirect()->route('perizinan_tampil_kabkota', [
            'triwulan' => $request->triwulan,
            'tahun' => $request->tahun
        ])->with('success', 'Data Perizinan Berhasil diTambahkan!');
    }
    public function show(string $id)
    {
        //
    }

    public function edit($sektor_id, Request $request)
    {
        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;
        $triwulan = $request->get('triwulan');
        $tahun = $request->get('tahun');

        $sektor = SektorPerizinan::findOrFail($sektor_id);
        $sektor_list = SektorPerizinan::all();

        $oss = Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('sektor_perizinan_id', $sektor_id)
            ->where('jenis_input', 'OSS RBA')
            ->where('triwulan', $triwulan)
            ->where('tahun', $tahun)
            ->first();

        $nonOss = Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('sektor_perizinan_id', $sektor_id)
            ->where('jenis_input', 'NON OSS RBA')
            ->where('triwulan', $triwulan)
            ->where('tahun', $tahun)
            ->first();

        $id_lama = $oss->id ?? $nonOss->id ?? null;

        return view('admin-kabkota.data-perizinan.edit', compact(
            'sektor',
            'sektor_list',
            'oss',
            'nonOss',
            'triwulan',
            'tahun',
            'id_lama'
        ));
    }

    public function update(Request $request, $sektor_id)
    {
        $request->validate([
            'oss_rba' => 'required|integer|min:0',
            'non_oss_rba' => 'required|integer|min:0',
            'triwulan' => 'required|integer|min:1|max:4',
            'tahun' => 'required|integer|min:2000',
        ]);

        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;

        // Cari data lama berdasarkan sektor_id (OSS dan NON OSS)
        $dataLama = Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('sektor_perizinan_id', $sektor_id)
            ->where('triwulan', $request->triwulan_lama)
            ->where('tahun', $request->tahun_lama)
            ->get();

        // Cek duplikat di triwulan & tahun baru
        $cekDuplikat = Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('sektor_perizinan_id', $sektor_id)
            ->where('triwulan', $request->triwulan)
            ->where('tahun', $request->tahun)
            ->whereNotIn('id', $dataLama->pluck('id')) // abaikan data lama
            ->exists();

        if ($cekDuplikat) {
            return redirect()->back()
                ->with('error', 'Data Untuk Sektor Ini Pada Triwulan ' . $request->triwulan . ' Tahun ' . $request->tahun . ' Sudah Ada!');
        }

        // Update atau buat OSS RBA
        Perizinan::updateOrCreate(
            [
                'kab_kota_id' => $kabKotaId,
                'sektor_perizinan_id' => $sektor_id,
                'jenis_input' => 'OSS RBA',
                'triwulan' => $request->triwulan_lama,
                'tahun' => $request->tahun_lama,
            ],
            [
                'jumlah' => $request->oss_rba,
                'triwulan' => $request->triwulan,
                'tahun' => $request->tahun,
            ]
        );

        // Update atau buat NON OSS RBA
        Perizinan::updateOrCreate(
            [
                'kab_kota_id' => $kabKotaId,
                'sektor_perizinan_id' => $sektor_id,
                'jenis_input' => 'NON OSS RBA',
                'triwulan' => $request->triwulan_lama,
                'tahun' => $request->tahun_lama,
            ],
            [
                'jumlah' => $request->non_oss_rba,
                'triwulan' => $request->triwulan,
                'tahun' => $request->tahun,
            ]
        );

        return redirect()->route('perizinan_tampil_kabkota', [
            'triwulan' => $request->triwulan,
            'tahun' => $request->tahun
        ])->with('success', 'Data Berhasil diPerbarui');
    }

    public function destroy($sektor_id, Request $request)
    {
        $kabKotaId = auth()->guard('admin')->user()->kab_kota_id;
        $triwulan = $request->get('triwulan');
        $tahun = $request->get('tahun');

        // Hapus semua entri perizinan untuk sektor ini
        Perizinan::where('kab_kota_id', $kabKotaId)
            ->where('sektor_perizinan_id', $sektor_id)
            ->where('triwulan', $triwulan)
            ->where('tahun', $tahun)
            ->delete();

        return redirect()->route('perizinan_tampil_kabkota', ['triwulan' => $triwulan, 'tahun' => $tahun])
            ->with('success', 'Data Perizinan Berhasil diHapus');
    }

    public function exportExcelKabKota($triwulan, $tahun)
    {
        $admin = auth()->guard('admin')->user();
        $kabKota = KabKota::findOrFail($admin->kab_kota_id);

        return Excel::download(
            new PerizinanKabKotaExport($admin->kab_kota_id, $triwulan, $tahun, $kabKota->nama),
            "Data-Perizinan-{$kabKota->nama}-Triwulan-{$triwulan}-Tahun-{$tahun}.xlsx"
        );
    }

    public function exportRekapTahunanKabKota($tahun)
    {
        $admin = auth()->guard('admin')->user();
        $kabKota = KabKota::findOrFail($admin->kab_kota_id);

        return Excel::download(
            new RekapPerizinanTahunanKabKotaExport($admin->kab_kota_id, $tahun, $kabKota->nama),
            "Data-Perizinan-{$kabKota->nama}-Tahun-{$tahun}.xlsx"
        );
    }

    public function exportExcelProvinsi($triwulan, $tahun)
    {
        return Excel::download(
            new PerizinanProvinsiExport($triwulan, $tahun),
            "Data-Perizinan-Provinsi-Triwulan-{$triwulan}-Tahun-{$tahun}.xlsx"
        );
    }

    public function exportRekapTahunanProvinsi($tahun)
    {
        return Excel::download(
            new RekapPerizinanTahunanProvinsiExport($tahun),
            "Data-Perizinan-Provinsi-Tahun-{$tahun}.xlsx"
        );
    }
}
