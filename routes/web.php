<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserloginController;
use App\Http\Controllers\Admin\DatakaryawanController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// route untuk user
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard'); 
});


// route untuk admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard'); 
    Route::get('/admin/userlogin', [UserloginController::class, 'index'])->name('admin.userlogin');
    Route::resource('/admin/datakaryawan', DatakaryawanController::class);
});

// route untuk pengajuan
Route::get('/pengajuanabsen', [PengajuanController::class, 'create']);
Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuanstore');
Route::get('/admin/pengajuan', [PengajuanController::class, 'index']);
Route::post('/admin/pengajuan/{id}/konfirmasi', [PengajuanController::class, 'konfirmasi'])->name('konfirmasi');
Route::post('/admin/pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name(('tolak'));


// route untuk presensi
Route::middleware(['auth'])->group(function () {
    Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
    Route::get('admin/presensi', [PresensiController::class, 'indexadmin'])->name('admin.presensi');
    Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');
    Route::post('/presensi/keluar', [PresensiController::class, 'presensiKeluar'])->name('presensi.keluar');
});

require __DIR__.'/auth.php';



