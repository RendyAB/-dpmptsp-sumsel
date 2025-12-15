<?php

namespace App\Http\Controllers;

use App\Models\NonPerizinan;
use App\Models\KabKota;
use App\Models\SektorPerizinan;
use App\Models\Validasi;
use App\Models\ValidasiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NonPerizinanController extends Controller
{
    /** 
     * INDEX
     */
    public function index(Request $request)
    {
        $query = NonPerizinan::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', 'desc')->get();

        return view('ptsp.non_perizinan.non_perizinan_index', compact('data'));
    }

    /** 
     * CREATE
     */
    public function create()
    {
        $user = Auth::guard('verifikator')->user();
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        return view('ptsp.non_perizinan.non_perizinan_form', [
            'kepada' => 'Pejabat Fungsional Penata Perizinan Ahli Madya',
            'perihal' => 'Permintaan Verifikasi Terkait Permohonan Non Perizinan',
            'petugas' => $user?->nama_petugas ?? '',
            'nip' => $user?->nip ?? '',
            'jabatan' => $user?->role ?? '',
            'kabkota' => $kabkota,
            'sektorPerizinan' => $sektorPerizinan,
        ]);
    }

    /** 
     * STORE
     */
    public function store(Request $request)
    {
        $user = Auth::guard('verifikator')->user();
        if (!$user) {
            return redirect()->route('login_admin')->with('error', 'Silakan login terlebih dahulu');
        }

        // ======================
        // VALIDASI KHUSUS NON PERIZINAN
        // ======================
        $validated = $request->validate([
            'kepada' => 'nullable|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tanggal_proses' => 'nullable|date',
            'petugas' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:255',
            'no_agenda' => 'nullable|string|max:100',
            'no_surat' => 'nullable|string|max:100',
            'jenis_izin' => 'nullable|string|max:150',
            'no_izin' => 'nullable|string|max:100',
            'nama_kapal' => 'nullable|string|max:150',
            'nib' => 'nullable|string|max:100',
            'id_izin' => 'nullable|string|max:100',
            'tgl_pmh' => 'nullable|date',
            'tgl_terima' => 'nullable|date',
            'jenis_pmh' => 'nullable|string|max:50',
            'cek_fisik' => 'nullable|string|max:100',
            'id_oss' => 'nullable|string|max:100',
            'id_proyek' => 'nullable|string|max:100',
            'nama_pemilik' => 'nullable|string|max:150',
            'no_usaha' => 'nullable|string|max:100',
            'tgl_izin' => 'nullable|date',
            'alamat' => 'nullable|string',
            'npwp' => 'nullable|string|max:100',
            'nik' => 'nullable|string|max:50',
            'jenis_pers' => 'nullable|string|max:100',
            'jenis_keg' => 'nullable|string|max:100',
            'sektor' => 'nullable|string|max:150',
            'skala' => 'nullable|string|max:50',
            'risiko' => 'nullable|string|max:50',
            'kbli' => 'nullable|string|max:255',
            'alamat_lokasi' => 'nullable|string',
            'kab' => 'nullable|string|max:150',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'investasi' => 'nullable|numeric',
            'dokumen' => 'nullable|string|max:50',
            'jumlah_dok' => 'nullable|string|max:255',
            'jenis_dok' => 'nullable|string|max:255',
            'no_verif' => 'nullable|string|max:100',
            'tgl_verif' => 'nullable|date',
            'dok_verif' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,disetujui,dikembalikan,ditolak',
            'catatan' => 'nullable|string',
            'tgl_terbit' => 'nullable|date',
            'ket_status' => 'nullable|string|max:255',

            // FILE input
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);


        // Upload PDF
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $filename);
            $validated['pdf_file'] = $filename;
        }

        // Simpan data
        $non = NonPerizinan::create($validated);

        // LEVEL MAP
        $currentLevelMap = [
            'petugas' => 1,
            'madya_1' => 2,
            'madya_2' => 3,
            'madya_3' => 4,
            'kabid' => 5,
        ];

        // $role = $user->role;
        // $level = $currentLevelMap[$role] ?? 1;

        $level = $currentLevelMap[$user->role];

        // Buat validasi awal
        $validasi = Validasi::create([
            'non_perizinan_id' => $non->id,
            'status' => $validated['status'],
            'current_level' => $level,
            'last_action_at' => now(),
        ]);

        // Log awal
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => $user->id,
            // 'role' => $role,
            'role' => $level,
            'status' => $validated['status'],
            'catatan' => 'Non perizinan baru masuk',
            'validated_at' => now(),
        ]);

        return redirect()->route('non_perizinan.index')
            ->with('success', 'Data Non Perizinan Berhasil diTambahkan');
    }

    /** 
     * EDIT
     */
    public function edit($id)
    {
        $non = NonPerizinan::findOrFail($id);
        $user = Auth::guard('verifikator')->user();
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        return view('ptsp.non_perizinan.non_perizinan_edit', [
            'non' => $non,
            'kepada' => 'Pejabat Fungsional Penata Perizinan Ahli Madya',
            'perihal' => 'Permintaan Verifikasi Terkait Permohonan Non Perizinan',
            'petugas' => $user?->nama_petugas ?? '',
            'nip' => $user?->nip ?? '',
            'jabatan' => $user?->role ?? '',
            'kabkota' => $kabkota,
            'sektorPerizinan' => $sektorPerizinan,
        ]);
    }

    /** 
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $non = NonPerizinan::findOrFail($id);

        $validated = $request->validate([
            'kepada' => 'nullable|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'tanggal_proses' => 'nullable|date',
            'petugas' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:50',
            'jabatan' => 'nullable|string|max:255',
            'no_agenda' => 'nullable|string|max:100',
            'no_surat' => 'nullable|string|max:100',
            'jenis_izin' => 'nullable|string|max:150',
            'no_izin' => 'nullable|string|max:100',
            'nama_kapal' => 'nullable|string|max:150',
            'nib' => 'nullable|string|max:100',
            'id_izin' => 'nullable|string|max:100',
            'tgl_pmh' => 'nullable|date',
            'tgl_terima' => 'nullable|date',
            'jenis_pmh' => 'nullable|string|max:50',
            'cek_fisik' => 'nullable|string|max:100',
            'id_oss' => 'nullable|string|max:100',
            'id_proyek' => 'nullable|string|max:100',
            'nama_pemilik' => 'nullable|string|max:150',
            'no_usaha' => 'nullable|string|max:100',
            'tgl_izin' => 'nullable|date',
            'alamat' => 'nullable|string',
            'npwp' => 'nullable|string|max:100',
            'nik' => 'nullable|string|max:50',
            'jenis_pers' => 'nullable|string|max:100',
            'jenis_keg' => 'nullable|string|max:100',
            'sektor' => 'nullable|string|max:150',
            'skala' => 'nullable|string|max:50',
            'risiko' => 'nullable|string|max:50',
            'kbli' => 'nullable|string|max:255',
            'alamat_lokasi' => 'nullable|string',
            'kab' => 'nullable|string|max:150',
            'no_telp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'investasi' => 'nullable|numeric',
            'dokumen' => 'nullable|string|max:50',
            'jumlah_dok' => 'nullable|string|max:255',
            'jenis_dok' => 'nullable|string|max:255',
            'no_verif' => 'nullable|string|max:100',
            'tgl_verif' => 'nullable|date',
            'dok_verif' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,disetujui,dikembalikan,ditolak',
            'catatan' => 'nullable|string',
            'tgl_terbit' => 'nullable|date',
            'ket_status' => 'nullable|string|max:255',

            // FILE input
            'pdf_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Upload PDF
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pdf'), $filename);
            $validated['pdf_file'] = $filename;
        }

        $non->update($validated);

        // Jika status berubah kembali ke menunggu
        if ($validated['status'] === 'menunggu') {

            $currentLevelMap = [
                'petugas' => 1,
                'madya_1' => 2,
                'madya_2' => 3,
                'madya_3' => 4,
                'kabid' => 5,
            ];

            $validasi = Validasi::firstOrCreate(
                ['non_perizinan_id' => $non->id],
                [
                    'status' => 'menunggu',
                    'current_level' => $currentLevelMap['madya_1'],
                    'last_action_at' => now(),
                ]
            );

            $validasi->update([
                'status' => 'menunggu',
                'current_level' => $currentLevelMap['madya_1'],
                'last_action_at' => now(),
            ]);

            ValidasiLog::create([
                'validasi_id' => $validasi->id,
                'admin_id' => Auth::guard('verifikator')->id(),
                'role' => Auth::guard('verifikator')->user()->role,
                'status' => 'menunggu',
                'catatan' => 'Data diperbarui dan kembali masuk proses validasi',
                'validated_at' => now(),
            ]);
        }

        return redirect()->route('non_perizinan.index')
            ->with('success', 'Data Non Perizinan Berhasil diPerbarui');
    }

    /** 
     * DELETE
     */
    public function destroy($id)
    {
        $non = NonPerizinan::findOrFail($id);

        if ($non->pdf_file && file_exists(public_path('uploads/pdf/' . $non->pdf_file))) {
            unlink(public_path('uploads/pdf/' . $non->pdf_file));
        }

        $non->delete();

        return redirect()->route('non_perizinan.index')
            ->with('success', 'Data Non Perizinan Berhasil diHapus');
    }

    public function detail($id)
    {
        // Ambil data dari tabel non_perizinan
        $non = NonPerizinan::findOrFail($id);

        // Jika butuh dropdown atau referensi lain (opsional, bisa dihapus)
        $kabkota = KabKota::orderBy('nama')->get();
        $sektorPerizinan = SektorPerizinan::orderBy('nama')->get();

        // Ambil validasi berdasarkan non_perizinan_id
        $validasi = Validasi::where('non_perizinan_id', $id)->first();

        // Ambil log jika validasi ada
        $validasiLogs = $validasi
            ? ValidasiLog::where('validasi_id', $validasi->id)
            ->orderBy('validated_at', 'desc')
            ->get()
            : collect();

        // Log terbaru
        $latestLog = $validasiLogs->first();

        return view('ptsp.validasi.non_perizinan_detail', compact(
            'non',
            'validasi',
            'validasiLogs',
            'latestLog',
            'kabkota',
            'sektorPerizinan'
        ));
    }

    public function status()
    {
        // $validasi = Validasi::with('latestLog')->get();

        // $statusList = [
        //     'menunggu' => 'Menunggu Review',
        //     'perbaikan' => 'Perbaikan',
        //     'proses' => 'Proses Validasi',
        //     'ditolak' => 'Ditolak',
        //     'disetujui' => 'Selesai',
        // ];

        // $statusCounts = array_fill_keys(array_keys($statusList), 0);

        // foreach ($validasi as $item) {
        //     $latestStatus = optional($item->latestLog)->status;
        //     if ($latestStatus && array_key_exists($latestStatus, $statusCounts)) {
        //         $statusCounts[$latestStatus]++;
        //     }
        // }

        // return view('ptsp.semua_status', compact('statusList', 'statusCounts'));

        $statusList = [
            'menunggu' => 'Menunggu Review',
            'diproses' => 'Proses Validasi',
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
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];

        $validasiList = Validasi::with(['perizinan', 'nonPerizinan'])
            ->where('current_level', $currentLevelMap['madya_1'])
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.madya', compact('validasiList'));
    }

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

        $validasiList = Validasi::with(['perizinan', 'nonPerizinan'])
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', compact('validasiList'));
    }
    public function approve(Validasi $validasi)
    {
        $currentLevel = $validasi->current_level;

        // log
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'disetujui',
            'catatan' => 'Sudah disetujui, lanjut level berikutnya',
            'validated_at' => now(),
        ]);

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

            // Perizinan
            if ($validasi->perizinan) {
                $validasi->perizinan->update(['status' => 'disetujui']);
            }

            // Non Perizinan
            if ($validasi->nonPerizinan) {
                $validasi->nonPerizinan->update(['status' => 'disetujui']);
            }
        }

        return $this->reloadValidasiList("Validasi Berhasil diSetujui.");
    }
    public function revisi(Request $request, Validasi $validasi)
    {
        $catatan = $request->input('catatan') ?: 'Permohonan dikembalikan untuk perbaikan';

        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'dikembalikan',
            'catatan' => $catatan,
            'validated_at' => now(),
        ]);

        $validasi->update([
            'status' => 'dikembalikan',
            'last_action_at' => now(),
        ]);

        if ($validasi->perizinan) {
            $validasi->perizinan->update(['status' => 'dikembalikan']);
        }

        if ($validasi->nonPerizinan) {
            $validasi->nonPerizinan->update(['status' => 'dikembalikan']);
        }

        return $this->reloadValidasiList("Permohonan Berhasil diKembalikan.");
    }
    public function reject(Validasi $validasi)
    {
        ValidasiLog::create([
            'validasi_id' => $validasi->id,
            'admin_id' => Auth::guard('verifikator')->id(),
            'role' => Auth::guard('verifikator')->user()->role,
            'status' => 'ditolak',
            'catatan' => 'Permohonan ditolak',
            'validated_at' => now(),
        ]);

        $validasi->update([
            'status' => 'ditolak',
            'last_action_at' => now(),
        ]);

        if ($validasi->perizinan) {
            $validasi->perizinan->update(['status' => 'ditolak']);
        }

        if ($validasi->nonPerizinan) {
            $validasi->nonPerizinan->update(['status' => 'ditolak']);
        }

        return $this->reloadValidasiList("Permohonan Berhasil diTolak.");
    }
    private function reloadValidasiList($message)
    {
        $currentLevelMap = [
            'madya_1' => 1,
            'madya_2' => 2,
            'madya_3' => 3,
            'kabid' => 4
        ];

        $user = Auth::guard('verifikator')->user();
        $level = $currentLevelMap[$user->role];

        $validasiList = Validasi::with(['perizinan', 'nonPerizinan'])
            ->where('current_level', $level)
            ->where('status', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ptsp.validasi.index', [
            'validasiList' => $validasiList,
            'success' => $message
        ]);
    }
}
