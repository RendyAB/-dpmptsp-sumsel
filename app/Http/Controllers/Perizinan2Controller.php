<?php

namespace App\Http\Controllers;

use App\Models\KabKota;
use App\Models\NonPerizinan;
use App\Models\Perizinan2;
use App\Models\SektorPerizinan;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ValidasiLog;


class Perizinan2Controller extends Controller
{

    public function index(Request $request)
    {
        $query = Perizinan2::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', 'desc')->get();

        return view('ptsp.perizinan.perizinan_index', compact('data'));
    }


    public function create()
    {
        // Ambil user login dari guard 'verifikator'
        $user = Auth::guard('verifikator')->user();

        // Ambil semua kabupaten/kota
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        return view('ptsp.perizinan.perizinan_form', [
            'kepada' => 'Pejabat Fungsional Penata Perizinan Ahli Madya',
            'perihal' => 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA',
            'petugas' => $user?->nama_petugas ?? '',
            'nip' => $user?->nip ?? '',
            'jabatan' => $user?->role ?? '',
            'kabkota' => $kabkota, // kirim data ke view
            'sektorPerizinan' => $sektorPerizinan, // kirim data ke view
        ]);
    }

    public function store(Request $request)
    {
        // Pastikan user login di guard verifikator
        $user = Auth::guard('verifikator')->user();
        if (!$user) {
            return redirect()->route('login_provinsi')->with('error', 'Silakan login terlebih dahulu');
        }

        // Validasi form
        $validated = $request->validate([
            'kepada' => 'nullable|string',
            'perihal' => 'nullable|string',
            'tanggal_proses' => 'nullable|date',
            'petugas' => 'nullable|string',
            'nip' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'no_pmh' => 'nullable|string',
            'no_keg' => 'nullable|string',
            'tgl_pmh' => 'nullable|date',
            'jenis_pmh' => 'nullable|string',
            'nama_pers' => 'nullable|string',
            'jenis_pers' => 'nullable|string',
            'jenis_keg' => 'nullable|string',
            'nib' => 'nullable|string',
            'npwp' => 'nullable|string',
            'sektor' => 'nullable|string',
            'luas' => 'nullable|string',
            'skala' => 'nullable|string',
            'risiko' => 'nullable|string',
            'kbli' => 'nullable|string',
            'nama_izin' => 'nullable|string',
            'pj_pers' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kab' => 'nullable|string',
            'no_telp' => 'nullable|string',
            'email' => 'nullable|string',
            'modal' => 'nullable|string',
            'dokumen' => 'nullable|string',
            'jumlah_dok' => 'nullable|string',
            'jenis_dok' => 'nullable|string',
            'no_verif' => 'nullable|string',
            'tgl_verif' => 'nullable|date',
            'dok_verif' => 'nullable|string',
            'status' => 'required|in:menunggu,disetujui,dikembalikan,ditolak',
            'catatan' => 'nullable|string',
            'tgl_terbit' => 'nullable|date',
            'ket_status' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Upload PDF
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $filename);
            $validated['pdf_file'] = $filename;
        }

        // Simpan data perizinan
        $perizinan = Perizinan2::create($validated);

        // Mapping level sesuai role user login
        $currentLevelMap = [
            'petugas' => 1,
            'madya_1' => 2,
            'madya_2' => 3,
            'madya_3' => 4,
            'kabid' => 5,
        ];
        // $userRole = $user->role;
        // $level = $currentLevelMap[$userRole] ?? 1; // default 1 kalau role gak ada di map

        $level = $currentLevelMap[$user->role];

        // Simpan entry validasi
        $validasi = Validasi::create([
            'perizinan_id' => $perizinan->id,
            'status' => $validated['status'],
            'current_level' => $level,
            'last_action_at' => now(),
        ]);

        // Buat log awal
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => $user->id,
            // 'role' => $userRole,
            'role' => $level,
            'status' => $validated['status'],
            'catatan' => 'Permohonan baru masuk',
            'validated_at' => now(),
        ]);

        return redirect()->route('perizinan_2.index')
            ->with('success', 'Data Berhasil diTambahkan dan Masuk ke Validasi');
    }

    public function edit($id)
    {
        // Ambil data perizinan berdasarkan id
        $perizinan = Perizinan2::findOrFail($id);

        // Ambil user login dari guard 'verifikator'
        $user = Auth::guard('verifikator')->user();

        // Ambil semua kabupaten/kota dan sektor perizinan
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        return view('ptsp.perizinan.perizinan_edit', [
            'perizinan' => $perizinan,
            'kepada' => 'Pejabat Fungsional Penata Perizinan Ahli Madya',
            'perihal' => 'Permintaan Verifikasi Terkait Permohonan Perizinan Berusaha OSS RBA',
            'petugas' => $user?->nama_petugas ?? '',
            'nip' => $user?->nip ?? '',
            'jabatan' => $user?->role ?? '',
            'kabkota' => $kabkota,
            'sektorPerizinan' => $sektorPerizinan,
        ]);
    }


    /**
     * Update data.
     */
    public function update(Request $request, $id)
    {
        $perizinan = Perizinan2::findOrFail($id);
        $validated = $request->validate([
            'kepada' => 'nullable|string',
            'perihal' => 'nullable|string',
            'tanggal_proses' => 'nullable|date',
            'petugas' => 'nullable|string',
            'nip' => 'nullable|string',
            'jabatan' => 'nullable|string',
            'no_pmh' => 'nullable|string',
            'no_keg' => 'nullable|string',
            'tgl_pmh' => 'nullable|date',
            'jenis_pmh' => 'nullable|string',
            'nama_pers' => 'nullable|string',
            'jenis_pers' => 'nullable|string',
            'jenis_keg' => 'nullable|string',
            'nib' => 'nullable|string',
            'npwp' => 'nullable|string',
            'sektor' => 'nullable|string',
            'luas' => 'nullable|string',
            'skala' => 'nullable|string',
            'risiko' => 'nullable|string',
            'kbli' => 'nullable|string',
            'nama_izin' => 'nullable|string',
            'pj_pers' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kab' => 'nullable|string',
            'no_telp' => 'nullable|string',
            'email' => 'nullable|string',
            'modal' => 'nullable|string',
            'dokumen' => 'nullable|string',
            'jumlah_dok' => 'nullable|string',
            'jenis_dok' => 'nullable|string',
            'no_verif' => 'nullable|string',
            'tgl_verif' => 'nullable|date',
            'dok_verif' => 'nullable|string',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string',
            'tgl_terbit' => 'nullable|date',
            'ket_status' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);


        // Upload PDF jika ada
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $filename);
            $validated['pdf_file'] = $filename;
        }

        // Update data perizinan
        $perizinan->update($validated);

        // =======================================================
        // LOGIKA UNTUK VALIDASI JIKA STATUS KEMBALI MENUNGGU
        // =======================================================
        if ($validated['status'] === 'menunggu') {
            $currentLevelMap = [
                'petugas' => 1,
                'madya_1' => 2,
                'madya_2' => 3,
                'madya_3' => 4,
                'kabid' => 5,
            ];

            // Cek apakah validasi sudah ada
            $validasi = Validasi::firstOrCreate(
                ['perizinan_id' => $perizinan->id],
                [
                    'status' => 'menunggu',
                    'current_level' => $currentLevelMap['madya_1'],
                    'last_action_at' => now(),
                ]
            );

            // Jika entry sudah ada, update status jadi menunggu
            $validasi->update([
                'status' => 'menunggu',
                'current_level' => $currentLevelMap['madya_1'],
                'last_action_at' => now(),
            ]);

            // Buat log baru
            ValidasiLog::create([
                'validasi_id' => $validasi->id,
                'admin_id' => Auth::guard('verifikator')->id(),
                'role' => Auth::guard('verifikator')->user()->role,
                'status' => 'menunggu',
                'catatan' => 'Permohonan diperbarui dan kembali masuk validasi',
                'validated_at' => now(),
            ]);
        }

        return redirect()->route('perizinan_2.index')
            ->with('success', 'Data Berhasil diPerbarui dan Masuk Validasi');
    }

    /**
     * Hapus data.
     */
    public function destroy($id)
    {
        $data = Perizinan2::findOrFail($id);

        // Hapus file PDF
        if ($data->pdf_file && file_exists(public_path('uploads/pdf/' . $data->pdf_file))) {
            unlink(public_path('uploads/pdf/' . $data->pdf_file));
        }

        $data->delete();

        return redirect()->route('perizinan_2.index')
            ->with('success', 'Data Berhasil diHapus');
    }

    public function status()
    {
        // $validasi = Validasi::all();

        // $statusList = [
        //     'menunggu' => 'Menunggu Review',
        //     'diproses' => 'Proses Validasi',
        //     'dikembalikan' => 'Dikembalikan',
        //     'ditolak' => 'Ditolak',
        //     'disetujui' => 'Selesai',
        // ];

        // $statusCounts = array_fill_keys(array_keys($statusList), 0);

        // foreach ($validasi as $item) {

        //     $status = $item->status;
        //     $level = $item->current_level; // 1 sampai 6

        //     // =============================
        //     // STATUS DIKEMBALIKAN
        //     // =============================
        //     if ($status === 'dikembalikan') {
        //         $statusCounts['dikembalikan']++;
        //         continue;
        //     }

        //     // =============================
        //     // STATUS DITOLAK
        //     // =============================
        //     if ($status === 'ditolak') {
        //         $statusCounts['ditolak']++;
        //         continue;
        //     }

        //     // =============================
        //     // STATUS SELESAI (level = 6)
        //     // =============================
        //     if ($level == 4 && $status === 'disetujui') {
        //         $statusCounts['disetujui']++;
        //         continue;
        //     }

        //     // =============================
        //     // STATUS PROSES (level 2-5)
        //     // =============================
        //     if ($level >= 2 && $level <= 3 && $status === 'menunggu') {
        //         $statusCounts['diproses']++;
        //         continue;
        //     }

        //     // =============================
        //     // STATUS MENUNGGU (level 1)
        //     // =============================
        //     if ($level == 1 && $status === 'menunggu') {
        //         $statusCounts['menunggu']++;
        //         continue;
        //     }
        // }

        // return view('ptsp.semua_status', [
        //     'statusList' => $statusList,
        //     'statusCounts' => $statusCounts,
        // ]);

        $statusList = [
            'menunggu' => 'Menunggu Review',
            'proses' => 'Proses Validasi',
            'dikembalikan' => 'Dikembalikan',
            'ditolak' => 'Ditolak',
            'disetujui' => 'Selesai'
        ];

        // hitung langsung dari tabel validasi
        $statusCounts = Validasi::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // pastikan semua status ada meskipun 0
        foreach ($statusList as $key => $value) {
            if (!isset($statusCounts[$key])) {
                $statusCounts[$key] = 0;
            }
        }

        return view('ptsp.semua_status', compact('statusList', 'statusCounts'));
    }




    public function listMadya1Validation()
    {
        // Map current level ke angka jika di DB pakai tinyint
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];
        // Ambil semua data validasi yang menunggu di level Madya 1
        $validasiList = Validasi::with('perizinan') // relasi ke Perizinan2
            ->where('current_level', $currentLevelMap['madya_1'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.madya', compact('validasiList'));
    }
    // Tampilkan daftar permohonan yang menunggu validasi Madya/Kabid
    public function validasiIndex()
    {

        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];

        $user = Auth::guard('verifikator')->user();
        $level = $currentLevelMap[$user->role] ?? null;

        if (!$level) {
            abort(403, 'Akses Ditolak');
        }

        $validasiList = Validasi::with('perizinan')
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', compact('validasiList'));
    }


    public function approve(Validasi $validasi)
    {
        $currentLevel = $validasi->current_level;

        // Tambah log validasi
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'disetujui',
            'catatan' => 'Sudah disetujui, lanjut level berikutnya',
            'validated_at' => now(),
        ]);

        // Update level atau status
        if ($currentLevel < 4) {
            $validasi->update([
                'current_level' => $currentLevel + 1,
                'last_action_at' => now(),
            ]);
        } else {
            $validasi->update([
                'status' => 'disetujui',
                'last_action_at' => now(),
            ]);

            if ($validasi->perizinan) {
                $validasi->perizinan->update(['status' => 'disetujui']);
            }
        }

        // Ambil ulang daftar validasi sesuai level user
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];
        $user = Auth::guard('verifikator')->user();
        $level = $currentLevelMap[$user->role] ?? null;

        $validasiList = Validasi::with('perizinan')
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', [
            'validasiList' => $validasiList,
            'success' => 'Validasi Berhasil diSetujui.'
        ]);
    }

    public function revisi(Request $request, Validasi $validasi)
    {
        // Ambil input catatan dari request
        $catatanInput = $request->input('catatan');
        $catatan = $catatanInput ?: 'Permohonan diKembalikan untuk Perbaikan';

        // Tambah log revisi di validasi_log
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'dikembalikan', // status revisi
            'catatan' => $catatan,
            'validated_at' => now(),
        ]);

        // Update status validasi
        $validasi->update([
            'status' => 'dikembalikan',
            'last_action_at' => now(),
        ]);

        // Update status di perizinan_2 jika ada
        if ($validasi->perizinan) {
            $validasi->perizinan->update([
                'status' => 'dikembalikan',
            ]);
        }

        // Ambil ulang daftar validasi sesuai level user
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];
        $user = Auth::guard('verifikator')->user();
        $level = $currentLevelMap[$user->role] ?? null;

        $validasiList = Validasi::with('perizinan')
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', [
            'validasiList' => $validasiList,
            'success' => 'Permohonan Berhasil diKembalikan.'
        ]);
    }


    public function reject(Validasi $validasi)
    {
        // Tambah log reject
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'ditolak',
            'catatan' => 'Permohonan ditolak',
            'validated_at' => now(),
        ]);

        // Update status validasi
        $validasi->update([
            'status' => 'ditolak',
            'last_action_at' => now(),
        ]);

        // Update status di perizinan_2 jika ada
        if ($validasi->perizinan) {
            $validasi->perizinan->update([
                'status' => 'ditolak',
            ]);
        }

        // Ambil ulang daftar validasi sesuai level user
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];
        $user = Auth::guard('verifikator')->user();
        $level = $currentLevelMap[$user->role] ?? null;

        $validasiList = Validasi::with('perizinan')
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', [
            'validasiList' => $validasiList,
            'success' => 'Permohonan Berhasil diTolak.'
        ]);
    }


    public function detail($id)
    {
        // Ambil perizinan dari tabel perizinan_2
        $perizinan = Perizinan2::findOrFail($id);
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        // Ambil validasi bila ada
        // $validasi = Validasi::where('perizinan_id', $id)->first();
        // $validasi = Validasi::with('perizinan')->findOrFail($id);

        $validasi = Validasi::with('perizinan')
            ->where('perizinan_id', $id)
            ->firstOrFail();

        // Ambil semua log untuk validasi ini
        $validasiLogs = $validasi ? ValidasiLog::where('validasi_id', $validasi->id)
            ->orderBy('validated_at', 'desc')
            ->get() : collect(); // collect() supaya selalu array walaupun null

        // Ambil log terbaru
        $latestLog = $validasiLogs->first(); // log terbaru di urutan pertama

        return view('ptsp.validasi.detail', compact(
            'perizinan',
            'validasi',
            'validasiLogs',
            'latestLog',
            'kabkota',
            'sektorPerizinan'
        ));
    }

    public function showByStatus($status)
    {
        // ================================
        // 1. Ambil data Perizinan
        // ================================
        $perizinanList = Perizinan2::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->jenis_data = 'perizinan';
                return $item;
            });

        // ================================
        // 2. Ambil data Non-Perizinan
        // ================================
        $nonPerizinanList = NonPerizinan::where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                $item->jenis_data = 'non_perizinan';
                return $item;
            });

        // ================================
        // 3. Gabungkan keduanya
        // ================================
        $mergedList = $perizinanList->merge($nonPerizinanList)
            ->sortByDesc('created_at')
            ->values();

        // ================================
        // 4. Ambil ValidasiLog terkait
        // ================================

        // Ambil semua ID yang berasal dari kedua tabel
        $perizinanIds = $perizinanList->pluck('id')->toArray();
        $nonPerizinanIds = $nonPerizinanList->pluck('id')->toArray();

        // Validasi untuk Perizinan
        $validasiForPerizinan = ValidasiLog::whereIn('validasi_id', function ($q) use ($perizinanIds) {
            $q->select('id')
                ->from('validasi')
                ->whereIn('perizinan_id', $perizinanIds);
        });

        // Validasi untuk Non Perizinan
        $validasiForNonPerizinan = ValidasiLog::whereIn('validasi_id', function ($q) use ($nonPerizinanIds) {
            $q->select('id')
                ->from('validasi')
                ->whereIn('non_perizinan_id', $nonPerizinanIds);
        });

        // Gabungkan validasi
        $validasiLogs = $validasiForPerizinan
            ->union($validasiForNonPerizinan)
            ->get();

        // ================================
        // 5. Kirim ke view
        // ================================
        return view('ptsp.status_detail', [
            'list' => $mergedList,
            'validasiLogs' => $validasiLogs,
            'status' => $status
        ]);
    }
}
