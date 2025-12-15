<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perizinan2;
use Illuminate\Support\Facades\DB;

class RekapPerizinanController extends Controller
{
    public function index()
    {
        // Ambil semua data perizinan tanpa filter
        $perizinan = DB::table('perizinan_2 as p')
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
            ->where('v.current_level', 4)
            ->select('p.*', 'v.status as status_validasi', 'v.current_level')
            ->orderBy('p.id', 'DESC')
            ->paginate(20);

        return view('ptsp.rekap.perizinan', [
            'perizinan' => $perizinan
        ]);
    }
}
