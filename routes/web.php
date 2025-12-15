<?php

use App\Http\Controllers\NonPerizinanPdfController;
use App\Models\SektorInvestasi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestasiController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\NonPerizinanController;
use App\Http\Controllers\WelcomeController;
use App\Models\Perizinan;
use App\Http\Controllers\Perizinan2Controller;
use App\Http\Controllers\Perizinan2PdfController;
use App\Http\Controllers\PerizinanExportController;
use App\Http\Controllers\PTSP\Rekap\RekapPerizinanController as RekapRekapPerizinanController;
use App\Http\Controllers\PTSP\Rekap\RekapPerizinanExportController;
use App\Http\Controllers\RekapNonPerizinanController;
use App\Http\Controllers\RekapPerizinanController;
use App\Models\Validasi;

// ROUTE BERANDA USER
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

//==================================================================================================================================================

// ROUTE LOGIN ADMIN PROVINSI DAN ADMIN KAB/KOTA 
Route::get('/login', function () {
    return redirect('/');
})->name('login');
// Route::get('/login-admin-provinsi', [AdminLoginController::class, 'showLoginFormProvinsi'])->name('login_provinsi');
Route::get('/login-admin', [AdminLoginController::class, 'showLogin'])->name('login_admin');
Route::post('/login-admin', [AdminLoginController::class, 'login'])->name('admin_login_submit');
Route::post('/logout-admin', [AdminLoginController::class, 'logout'])->name('admin_logout');
Route::get('/reload-captcha', function () {
    if (!request()->ajax()) {
        abort(403);
    }

    return response()->json([
        'captcha' => captcha_src('flat')
    ]);
})->name('reload.captcha');


// ADMIN PROVINSI
Route::middleware(['admin.auth', 'role:provinsi'])->group(function () {
    // DASHBOARD
    Route::get('/admin-provinsi/dashboard', function () {
        return view('admin-provinsi.dashboard');
    })->name('provinsi_dashboard');

    // DATA INVESTASI
    Route::get('/admin-provinsi/investasi/view/{kab_kota_id?}', [InvestasiController::class, 'index_provinsi'])->name('investasi_tampil_provinsi');

    // EXPORT EXCEL DATA INVESTASI
    Route::get('/admin-provinsi/investasi/export-excel', [InvestasiController::class, 'exportExcel'])->name('investasi_export_excel_provinsi');

    // EXPORT EXCEL PERTAHUN DATA INVESTASI
    Route::get('/admin-provinsi/export-rekap-investasi-tahunan', [InvestasiController::class, 'exportRekapInvestasiTahunan'])->name('export_rekap_investasi_tahunan_provinsi');

    // DATA PERIZINAN
    Route::get('/admin-provinsi/perizinan/view', [PerizinanController::class, 'index_provinsi'])->name('perizinan_tampil_provinsi');

    // EXPORT EXCEL DATA PERIZINAN
    Route::get('/admin-provinsi/perizinan/export-excel/{triwulan}/{tahun}', [PerizinanController::class, 'exportExcelProvinsi'])->name('perizinan_export_excel_provinsi');

    // EXPORT EXCEL PERTAHUN DATA PERIZINAN
    Route::get('/admin-provinsi/export-rekap-perizinan-tahunan/{tahun}', [PerizinanController::class, 'exportRekapTahunanProvinsi'])->name('export_rekap_perizinan_tahunan_provinsi');
});

// ==================================================================================================================================================

// ADMIN KAB/KOTA
Route::middleware(['auth:admin', 'role:kab_kota'])->group(function () {
    // DASHBOARD
    Route::get('/admin-kabkota/dashboard', function () {
        return view('admin-kabkota.dashboard');
    })->name('kab_kota_dashboard');

    // DATA INVESTASI
    Route::get('/admin-kabkota/investasi/view', [InvestasiController::class, 'index_kabkota'])->name('investasi_tampil_kabkota');
    Route::get('/admin-kabkota/investasi/create/{triwulan?}/{tahun?}', [InvestasiController::class, 'create'])->name('investasi_create');
    Route::post('/admin-kabkota/investasi/simpan', [InvestasiController::class, 'store'])->name('investasi_simpan');
    Route::get('/admin-kabkota/investasi/{id}/edit', [InvestasiController::class, 'edit'])->name('investasi_edit');
    Route::put('/admin-kabkota/investasi/update/{id}', [InvestasiController::class, 'update'])->name('investasi_update');
    Route::delete('/admin-kabkota/investasi/hapus/{id}', [InvestasiController::class, 'destroy'])->name('investasi_destroy');

    Route::get('/get-sektor/{kategori_id}', function ($kategori_id) {
        $sektor = SektorInvestasi::where('kategori_sektor_id', $kategori_id)->get();
        return response()->json($sektor);
    });

    // EXPORT EXCEL DATA INVESTASI
    Route::get('/admin-kabkota/investasi/export-excel', [InvestasiController::class, 'exportExcel'])->name('investasi_export_excel_kabkota');

    // EXPORT EXCEL PERTAHUN DATA INVESTASI
    Route::get('/admin-kabkota/export-rekap-investasi-tahunan', [InvestasiController::class, 'exportRekapInvestasiTahunan'])->name('export_rekap_investasi_tahunan_kabkota');

    // DATA PERIZINAN
    Route::get('/admin-kabkota/perizinan/view', [PerizinanController::class, 'index_kabkota'])->name('perizinan_tampil_kabkota');
    Route::get('/admin-kabkota/perizinan/create', [PerizinanController::class, 'create'])->name('perizinan_create');
    Route::post('/admin-kabkota/perizinan/simpan', [PerizinanController::class, 'store'])->name('perizinan_simpan');
    Route::get('/admin-kabkota/perizinan/{sektor_id}/edit', [PerizinanController::class, 'edit'])->name('perizinan_edit');
    Route::put('/admin-kabkota/perizinan/update/{sektor_id}', [PerizinanController::class, 'update'])->name('perizinan_update');
    Route::delete('/admin-kabkota/perizinan/hapus/{sektor_id}', [PerizinanController::class, 'destroy'])->name('perizinan_destroy');

    // EXPORT EXCEL DATA PERIZINAN
    Route::get('/admin-kabkota/perizinan/export-excel/{triwulan}/{tahun}', [PerizinanController::class, 'exportExcelKabKota'])->name('perizinan_export_excel_kabkota');

    // EXPORT EXCEL PERTAHUN DATA PERIZINAN
    Route::get('/admin-kabkota/export-rekap-perizinan-tahunan/{tahun}', [PerizinanController::class, 'exportRekapTahunanKabKota'])->name('export_rekap_perizinan_tahunan_kabkota');
});


Route::middleware(['auth:verifikator'])
    ->get('/verifikator/test', function () {
        return view('verifikator_test');
    })
    ->name('verifikator_test');
Route::resource('perizinan_2', Perizinan2Controller::class)->except(['show']);
Route::resource('non_perizinan', NonPerizinanController::class)->except(['show']);
Route::get('/perizinan_2/status', [Perizinan2Controller::class, 'status'])->name('perizinan_2.status');

Route::get('/perizinan/validasi', [Perizinan2Controller::class, 'validasi'])
    ->name('perizinan.validasi')
    ->middleware('role:madya_1,madya_2,madya_3,kabid');

Route::middleware(['auth:verifikator', 'role:madya_1'])->group(function () {
    // Daftar permohonan yang harus divalidasi Madya 1
    Route::get('/validasi/madya1', [Perizinan2Controller::class, 'listMadya1Validation'])
        ->name('validasi.madya1');
});

Route::get('/validasi', [Perizinan2Controller::class, 'validasiIndex'])
    ->name('perizinan2.validasi')
    ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);


Route::post('/validasi/{validasi}/approve', [Perizinan2Controller::class, 'approve'])
    ->name('perizinan2.validasi.approve')
    ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);

// Revisi (kembalikan)
Route::post('/validasi/{validasi}/revisi', [Perizinan2Controller::class, 'revisi'])
    ->name('perizinan2.validasi.revisi')
    ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);

// Reject (tolak)
Route::post('/validasi/{validasi}/reject', [Perizinan2Controller::class, 'reject'])
    ->name('perizinan2.validasi.reject')
    ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);

// Route::get(
//     '/validasi/{id}/detail',
//     [Perizinan2Controller::class, 'detail']
// )
//     ->name('perizinan2.validasi.detail')
//     ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);

Route::post('/logout-verifikator', [AdminLoginController::class, 'logoutVerifikator'])
    ->name('verifikator_logout')
    ->middleware(['auth:verifikator', 'role:super_admin,petugas,madya_1,madya_2,madya_3,kabid']);

Route::get('/perizinan/status/{status}', [Perizinan2Controller::class, 'showByStatus'])
    ->name('perizinan.status.detail');
Route::get('/non-perizinan/status/{status}', [Perizinan2Controller::class, 'showByStatus'])
    ->name('non_perizinan.status.detail');

Route::get('/export/status/{id}', [PerizinanExportController::class, 'exportStatus'])
    ->name('perizinan.export.status');


// Route::get(
//     '/validasi/{id}/detail',
//     [NonPerizinanController::class, 'detail']
// )
//     ->name('non_perizinan.validasi.detail')
//     ->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid']);


Route::get('/validasi/{id}/detail', function ($id) {
    $validasi = Validasi::findOrFail($id);

    if ($validasi->perizinan_id) {
        return app(Perizinan2Controller::class)->detail($validasi->perizinan_id);
    }

    if ($validasi->non_perizinan_id) {
        return app(NonPerizinanController::class)->detail($validasi->non_perizinan_id);
    }
})->name('validasi.detail');

Route::prefix('validasi-non')->name('nonperizinan.validasi.')->middleware(['auth:verifikator', 'role:madya_1,madya_2,madya_3,kabid'])->group(function () {
    Route::post('/{validasi}/approve', [NonPerizinanController::class, 'approve'])->name('approve');
    Route::post('/{validasi}/revisi', [NonPerizinanController::class, 'revisi'])->name('revisi');
    Route::post('/{validasi}/reject', [NonPerizinanController::class, 'reject'])->name('reject');
});

Route::match(['GET', 'POST'], '/generate/perizinan_2', [Perizinan2PdfController::class, 'generate'])
    ->name('perizinan2.generate');
Route::match(['GET', 'POST'], '/generate/non-perizinan', [Perizinan2PdfController::class, 'generate'])
    ->name('non_perizinan.generate');

Route::get(
    '/nonperizinan/{id}/edit',
    [NonPerizinanController::class, 'edit']
)->name('non_perizinan.edit');

Route::get('/non-perizinan/pdf', [NonPerizinanPdfController::class, 'generate'])
    ->name('non_perizinan.generate');


Route::get('/rekap/perizinan', [RekapPerizinanController::class, 'index'])
    ->name('rekap.perizinan');

Route::get('/rekap/perizinan/export', [RekapPerizinanExportController::class, 'export'])
    ->name('rekap.perizinan.export');

Route::get('/rekap/non-perizinan', [RekapNonPerizinanController::class, 'index'])
    ->name('rekap.non_perizinan');

Route::middleware(['auth:verifikator', 'role:super_admin'])->group(function () {
    Route::get('/admin/kelola-user/view', [KelolaUserController::class, 'index'])->name('kelola_user_tampil');
    Route::get('/admin/kelola-user/create', [KelolaUserController::class, 'create'])->name('kelola_user_create');
    Route::post('/admin/kelola-user/simpan', [KelolaUserController::class, 'store'])->name('kelola_user_simpan');
    Route::get('/admin/kelola-user/{id}/edit', [KelolaUserController::class, 'edit'])->name('kelola_user_edit');
    Route::put('/admin/kelola-user/update/{id}', [KelolaUserController::class, 'update'])->name('kelola_user_update');
    Route::delete('/admin/kelola-user/hapus/{id}', [KelolaUserController::class, 'destroy'])->name('kelola_user_destroy');
});
