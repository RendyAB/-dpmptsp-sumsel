<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class RoleMiddleware
// {

//     public function handle(Request $request, Closure $next, $role)
//     {

//         if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== $role) {
//             abort(403);
//         }

//         return $next($request);

//     }
// }


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles) // terima multiple role
    {
        $user = null;

        // Cek admin lama
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        }
        // Cek admin verifikator
        else if (Auth::guard('verifikator')->check()) {
            $user = Auth::guard('verifikator')->user();
        }
        // Tidak login di dua-duanya
        else {
            abort(403, 'Akses Ditolak. Login dibutuhkan.');
        }

        // Cek role user, salah → 403
        if (!in_array($user->role, $roles)) { // bisa cek banyak role
            abort(403, 'Akses Ditolak. Role tidak cocok.');
        }

        return $next($request);
    }
}


