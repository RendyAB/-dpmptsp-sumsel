<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapNonPerizinanController extends Controller
{
    public function index()
    {
        // Ambil data non perizinan yang sudah disetujui (status terakhir)
        $perizinan = DB::table('non_perizinan as p')
            ->leftJoin('validasi as v', function ($join) {
                $join->on('v.perizinan_id', '=', 'p.id')
                    ->whereRaw('v.id = (
                        SELECT v2.id FROM validasi v2 
                        WHERE v2.perizinan_id = p.id 
                        ORDER BY v2.id DESC 
                        LIMIT 1
                    )');
            })
            ->where('v.status', 'disetujui')
            ->where('v.current_level', 4) // level final non-perizinan → sesuaikan kalau beda
            ->select(
                'p.*',
                'v.status as status_validasi',
                'v.current_level'
            )
            ->orderBy('p.id', 'DESC')
            ->paginate(20);

        return view('ptsp.rekap.non_perizinan', [
            'perizinan' => $perizinan
        ]);
    }
}
