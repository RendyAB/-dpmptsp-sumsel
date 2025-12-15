<?php

namespace App\Http\Controllers;

use App\Models\Investasi;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Visitor;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $triwulan = $request->get('triwulan');
        $tahun = $request->get('tahun');

        $investasiQuery = Investasi::query();
        $perizinanQuery = Perizinan::query();

        // Filter utama untuk total
        if ($triwulan && $tahun) {
            $investasiQuery->where('triwulan', $triwulan)
                ->where('tahun', $tahun);

            $perizinanQuery->where('triwulan', $triwulan)
                ->where('tahun', $tahun);
        }

        $totalPmaRealisasi = $investasiQuery->sum('realisasi_pma');
        $totalPmdnRealisasi = $investasiQuery->sum('realisasi_pmdn');
        $totalPmaLkpm = $investasiQuery->sum('lkpm_pma');
        $totalPmdnLkpm = $investasiQuery->sum('lkpm_pmdn');
        $totalPerizinan = $perizinanQuery->sum('jumlah');

        // Ambil semua kab/kota urut ID
        $kabKotaList = DB::table('kab_kota')
            ->orderBy('id', 'asc')
            ->pluck('nama', 'id');

        // PMA per daerah (LEFT JOIN supaya yang kosong tetap muncul)
        $pmaData = DB::table('kab_kota')
            ->leftJoin('investasi', function ($join) use ($triwulan, $tahun) {
                $join->on('kab_kota.id', '=', 'investasi.kab_kota_id');
                if ($triwulan && $tahun) {
                    $join->where('investasi.triwulan', $triwulan)
                        ->where('investasi.tahun', $tahun);
                }
            })
            ->select('kab_kota.id', DB::raw('COALESCE(SUM(investasi.realisasi_pma), 0) as total'))
            ->groupBy('kab_kota.id')
            ->orderBy('kab_kota.id', 'asc')
            ->pluck('total', 'id');

        // PMDN per daerah
        $pmdnData = DB::table('kab_kota')
            ->leftJoin('investasi', function ($join) use ($triwulan, $tahun) {
                $join->on('kab_kota.id', '=', 'investasi.kab_kota_id');
                if ($triwulan && $tahun) {
                    $join->where('investasi.triwulan', $triwulan)
                        ->where('investasi.tahun', $tahun);
                }
            })
            ->select('kab_kota.id', DB::raw('COALESCE(SUM(investasi.realisasi_pmdn), 0) as total'))
            ->groupBy('kab_kota.id')
            ->orderBy('kab_kota.id', 'asc')
            ->pluck('total', 'id');

        // Perizinan per daerah
        $perizinanData = DB::table('kab_kota')
            ->leftJoin('perizinan', function ($join) use ($triwulan, $tahun) {
                $join->on('kab_kota.id', '=', 'perizinan.kab_kota_id');
                if ($triwulan && $tahun) {
                    $join->where('perizinan.triwulan', $triwulan)
                        ->where('perizinan.tahun', $tahun);
                }
            })
            ->select('kab_kota.id', DB::raw('COALESCE(SUM(perizinan.jumlah), 0) as total'))
            ->groupBy('kab_kota.id')
            ->orderBy('kab_kota.id', 'asc')
            ->pluck('total', 'id');

        // Siapkan data final untuk chart
        $pmaPerDaerah = [];
        $pmdnPerDaerah = [];
        $perizinanPerDaerah = [];

        foreach ($kabKotaList as $id => $nama) {
            $pmaPerDaerah[$nama] = $pmaData[$id] ?? 0;
            $pmdnPerDaerah[$nama] = $pmdnData[$id] ?? 0;
            $perizinanPerDaerah[$nama] = $perizinanData[$id] ?? 0;
        }

        // Kunci session untuk mencatat waktu kunjungan terakhir
        $sessionKey = 'last_visit_time';

        // Ambil waktu dari session
        $lastVisit = $request->session()->get($sessionKey);

        // Atur waktu sekarang
        $now = Carbon::now();

        // Jika tidak ada sesi atau sudah lebih dari 10 menit, catat kunjungan baru
        if (!$lastVisit || $now->diffInMinutes($lastVisit) >= 10) {
            // Mencatat kunjungan
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            // Perbarui waktu kunjungan di session
            $request->session()->put($sessionKey, $now);
        }

        $statistik = [
            'today' => 0,
            'this_week' => 0,
            'this_month' => 0,
            'this_year' => 0,
            'total' => 0,
        ];

        $namaHariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $namaBulanIndo = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        // Mengambil data untuk grafik (7 hari terakhir)
        $labels = [];
        $dataKunjungan = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $hariIndo = $namaHariIndo[$date->dayOfWeek];
            $bulanIndo = $namaBulanIndo[$date->month - 1];

            $labels[] = $hariIndo . ', ' . $date->day . ' ' . $bulanIndo;

            $count = Visitor::whereDate('visited_at', $date)->count();
            $dataKunjungan[] = $count;
        }

        $statistik['today'] = end($dataKunjungan);
        $statistik['this_week'] = array_sum($dataKunjungan);
        $statistik['this_month'] = Visitor::whereBetween('visited_at', [Carbon::today()->startOfMonth(), Carbon::today()])->count();
        $statistik['this_year'] = Visitor::whereBetween('visited_at', [Carbon::today()->startOfYear(), Carbon::today()])->count();
        $statistik['total'] = Visitor::count();

        return view('welcome', compact(
            'totalPmaRealisasi',
            'totalPmdnRealisasi',
            'totalPmaLkpm',
            'totalPmdnLkpm',
            'totalPerizinan',
            'pmaPerDaerah',
            'pmdnPerDaerah',
            'perizinanPerDaerah',
            'statistik',
            'labels',
            'dataKunjungan'
        ));
    }
}
