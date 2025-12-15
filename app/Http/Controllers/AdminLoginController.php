<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\AdminVerifikator;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function showLogin()
    {
        return view('login-admin');
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        //     'captcha' => 'required|captcha',
        // ], [
        //     'captcha.required' => 'Kode Captcha Harus diisi',
        //     'captcha.captcha' => 'Kode Captcha yang Anda Masukkan Salah',
        // ]);

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'captcha'  => 'required|captcha',
        ], [
            'captcha.required' => 'Kode Captcha Harus diisi',
            'captcha.captcha'  => 'Kode Captcha yang Anda Masukkan Salah',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $username = $request->username;
        $password = $request->password;

        // ======================================================
        // (1) LOGIN ADMIN VERIFIKATOR BARU (bcrypt)
        // ======================================================
        if (
            Auth::guard('verifikator')->attempt([
                'username' => $username,
                'password' => $password,
            ])
        ) {

            $request->session()->regenerate();
            $admin = Auth::guard('verifikator')->user();

            return $this->redirectVerifikator($admin);
        }

        // ======================================================
        // (2) LOGIN ADMIN LAMA (bcrypt)
        // ======================================================
        if (
            Auth::guard('admin')->attempt([
                'username' => $username,
                'password' => $password,
            ])
        ) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();

            return $this->redirectAdminLama($admin);
        }

        // ======================================================
        // (3) LOGIN ADMIN LAMA PLAINTEXT / MD5 (sistem native)
        // ======================================================
        $admin = Admin::where('username', $username)->first();

        if ($admin) {

            // plaintext
            if ($admin->password === $password) {
                Auth::guard('admin')->login($admin);
                return $this->redirectAdminLama($admin);
            }

            // md5
            if ($admin->password === md5($password)) {
                Auth::guard('admin')->login($admin);
                return $this->redirectAdminLama($admin);
            }
        }

        return back()->withInput()->with('error', 'Username atau Password Salah!');
    }

    // ======================================================
    // REDIRECT ADMIN VERIFIKATOR BARU
    // ======================================================
    // private function redirectVerifikator($user)
    // {
    //     return match ($user->role) {
    //         'super_admin' => redirect()->route('provinsi_dashboard'),
    //          'madya_1' => redirect()->route('dashboard.madya1'),
    //          'madya_2' => redirect()->route('dashboard.madya2'),
    //          'madya_3' => redirect()->route('dashboard.madya3'),
    //          'kabid' => redirect()->route('dashboard.kabid'),
    //         default => abort(403),
    //     };
    // }

    private function redirectVerifikator($user)
    {
        return redirect()->route('verifikator_test')
            ->with('success', 'Selamat Datang, ' . ($user->nama_petugas ?? '') . ' DPMPTSP Sumatera Selatan!');
    }


    // ======================================================
    // REDIRECT ADMIN LAMA
    // ======================================================
    private function redirectAdminLama($admin)
    {
        return match ($admin->role) {
            'provinsi' => redirect()->route('provinsi_dashboard')
                ->with('success', 'Selamat Datang, Admin DPMPTSP Provinsi Sumatera Selatan!'),

            'kab_kota' => redirect()->route('kab_kota_dashboard')
                ->with('success', 'Selamat Datang, Admin DPMPTSP ' . ($admin->kabkota->nama ?? 'Kabupaten/Kota') . '!'),

            default => abort(403),
        };
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('verifikator')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-admin');
    }

    public function logoutVerifikator(Request $request)
    {
        // Logout dari guard verifikator
        Auth::guard('verifikator')->logout();

        // Hapus session dan token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/')
            ->with('success', 'Logout Verifikator Berhasil!');
    }
}
