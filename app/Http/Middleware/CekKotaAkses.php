<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekKotaAkses
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth('admin')->user()->role == 'kab_kota') {
            $id_kota_user = auth('admin')->user()->kab_kota_id;
            $id_kota_request = $request->route('kota');
            if ($id_kota_user != $id_kota_request) {
                abort(403);
            }
        }

        return $next($request);
    }
}
