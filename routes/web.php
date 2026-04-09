<?php

use App\Http\Controllers\{
    KategoriController,
    PengaduanController,
    TanggapanController,
    OrangtuaController,
    AuthController,
    UserImportController,
    UserController,
    DashboardController,
    ProfileController,
    WelcomeController,
    RatingController,

};
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    ResetPasswordController
};


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return 'OK';
});
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


Auth::routes();

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {

    // PROFILE (ADMIN, PETUGAS, ORANGTUA)
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // NOTIFIKASI
    Route::post('/notifikasi/baca/{id}', function ($id) {
        Notifikasi::where('notifikasi_id', $id)
            ->update(['sudah_dibaca' => true]);

        return response()->json(['success' => true]);
    })->name('notifikasi.baca');
    Route::post('/notifikasi/baca-semua', function () {
        Notifikasi::where('user_id', auth()->user()->user_id)
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return response()->json(['success' => true]);
    })->name('notifikasi.bacaSemua');
    Route::delete('/notifikasi/{id}', function ($id) {

        $notif = Notifikasi::findOrFail($id);

        // 🔒 biar tidak bisa hapus notif orang lain
        if ($notif->user_id != auth()->user()->user_id) {
            abort(403);
        }

        $notif->delete();

        return response()->json(['success' => true]);
    })->name('notifikasi.hapus');

    Route::delete('/notifikasi/hapus-semua', function () {

        Notifikasi::where('user_id', auth()->user()->user_id)->delete();

        return response()->json(['success' => true]);
    })->name('notifikasi.hapusSemua');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        // Route::get('/dashboard', fn() => view('dashboard.admin'))
        //     ->name('admin.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::resource('kategori', KategoriController::class);
        Route::resource('orangtua', OrangtuaController::class);

        Route::get('pengaduan', [PengaduanController::class, 'index'])
            ->name('admin.pengaduan.index');

        Route::get('pengaduan/{id}', [PengaduanController::class, 'show'])
            ->name('admin.pengaduan.show');

        Route::post(
            'pengaduan/{pengaduan}/status',
            [PengaduanController::class, 'updateStatus']
        )->name('admin.pengaduan.status');
        Route::post('tanggapan', [TanggapanController::class, 'store'])
            ->name('admin.tanggapan.store');

        Route::get('/users/import', [UserImportController::class, 'form'])
            ->name('users.import.form');

        Route::post('/users/import', [UserImportController::class, 'import'])
            ->name('users.import');

        Route::post('/orangtua/import', [OrangtuaController::class, 'import'])
            ->name('orangtua.import');

        Route::resource('users', UserController::class);
    });

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->group(function () {

        // Route::get('/dashboard', fn() => view('dashboard.petugas'))
        //     ->name('petugas.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('petugas.dashboard');
        Route::resource('pengaduan', PengaduanController::class)
            ->name('index', 'petugas.pengaduan.index')
            ->name('create', 'petugas.pengaduan.create')
            ->name('store', 'petugas.pengaduan.store')
            ->name('show', 'petugas.pengaduan.show')
            ->name('edit', 'petugas.pengaduan.edit')
            ->name('update', 'petugas.pengaduan.update');

        Route::post(
            'pengaduan/{pengaduan}/status',
            [PengaduanController::class, 'updateStatus']
        )->name('petugas.pengaduan.status');

        Route::post('tanggapan', [TanggapanController::class, 'store'])
            ->name('petugas.tanggapan.store');
    });

/*
|--------------------------------------------------------------------------
| ORANGTUA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:orangtua'])
    ->prefix('orangtua')
    ->group(function () {

        // Route::get('/dashboard', fn() => view('dashboard.orangtua'))
        //     ->name('orangtua.dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('orangtua.dashboard');

        Route::resource('pengaduan', PengaduanController::class)
            ->name('destroy', 'orangtua.pengaduan.destroy')
            ->name('index', 'orangtua.pengaduan.index')
            ->name('create', 'orangtua.pengaduan.create')
            ->name('store', 'orangtua.pengaduan.store')
            ->name('show', 'orangtua.pengaduan.show')
            ->name('edit', 'orangtua.pengaduan.edit')
            ->name('update', 'orangtua.pengaduan.update');

        Route::post('tanggapan', [TanggapanController::class, 'store'])
            ->name('orangtua.tanggapan.store');

        Route::post('/pengaduan/{id}/konfirmasi', [PengaduanController::class, 'konfirmasi'])
            ->name('pengaduan.konfirmasi');
        Route::post('/rating/{id}', [RatingController::class, 'store'])
            ->name('rating.store');
    });

    Route::get('/fix-php', function() {
    $file = base_path('vendor/composer/platform_check.php');
    if (file_exists($file)) {
        unlink($file);
        return "File platform_check berhasil dihapus! Silakan buka halaman utama.";
    }
    return "File sudah tidak ada.";
});
