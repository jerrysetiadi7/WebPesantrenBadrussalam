<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController as dash;
use App\Http\Controllers\kyaiDashboardController as kyai;
use App\Http\Controllers\adminController as adm;
use App\Http\Controllers\galeriController as glr;
use App\Http\Controllers\dakwahController as dkw;
use App\Http\Controllers\kategoriController as ktg;
use App\Http\Controllers\ZiswafController as zsf;
use App\Http\Controllers\Kyai\KyaiPertanyaanController as kyaip;
use App\Http\Controllers\pertanyaanController as ptn;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\AuthenticatedSessionController as lgn;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [dash::class, 'index'])->name('dashboard');
// routes/web.php
// routes/web.php
// Route::get('/admin', [adm::class, 'index'])->name('admin');
// Route::post('/admin-pesantren', [adm::class, 'store'])->name('admin.store');
// Route::put('/admin-pesantren/{id}', [adm::class, 'update'])->name('admin.update');
// Route::delete('/admin-pesantren/{id}', [adm::class, 'destroy'])->name('admin.destroy');

//galeri
Route::get('/galeri', [glr::class, 'index'])->name('galeri');
Route::post('/galeri-pesantren', [glr::class, 'store'])->name('galeri.store');
Route::put('/galeri-pesantren/{id}', [glr::class, 'update'])->name('galeri.update');
Route::delete('/galeri-pesantren/{id}', [glr::class, 'destroy'])->name('galeri.destroy');
route::resource('kategori',glr::class);

//dakwah
route::get('/dakwah', [dkw::class, 'index'])->name('dakwah');
Route::post('/dakwah-pesantren', [dkw::class, 'store'])->name('dakwah.store');
Route::put('/dakwah-pesantren/{id}', [dkw::class, 'update'])->name('dakwah.update');
Route::delete('/dakwah-pesantren/{id}', [dkw::class, 'destroy'])->name('dakwah.destroy');
route::resource('kategori',dkw::class);

//kategori
route::get('/kategori', [ktg::class, 'index'])->name('kategori');
Route::post('/kategori-pesantren', [ktg::class, 'store'])->name('kategori.store');
Route::put('/kategori-pesantren/{id}', [ktg::class, 'update'])->name('kategori.update');
Route::delete('/kategori-pesantren/{id}', [ktg::class, 'destroy'])->name('kategori.destroy');
route::resource('kategori',ktg::class);

//ziswaf
Route::post('/ziswaf', [zsf::class, 'store'])->name('ziswaf.store');

//login
require __DIR__.'/auth.php';
Route::get('/login', [lgn::class, 'create'])->name('login');
Route::post('/login', [lgn::class, 'store'])->name('login.submit');
Route::post('/logout', [lgn::class, 'destroy'])->name('logout');

// admin dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [dash::class, 'index'])->name('admin.dashboard');
        return view('pages.dashboard');
    // })->name('pages.dashboard');
});

//kyai dashboard dan pertanyaan
Route::middleware(['auth', 'role:kyai'])->group(function () {
    Route::get('/kyaiDashboard', [dash::class, 'index'])->name('kyai.dashboard');
        return view('pages.kyaiDashboard');
    // })->name('pages.dashboard');
});

// Route::middleware(['auth', 'role:kyai'])->prefix('kyai')->group(function () {
//     Route::get('/dashboard', [dash::class, 'index'])->name('kyai.dashboard');
//     Route::get('/pertanyaan', [kyaip::class, 'index'])->name('kyai.pertanyaan.index');
//     Route::get('/pertanyaan/{id}/jawab', [kyaip::class, 'jawab'])->name('kyai.pertanyaan.jawab');
//     Route::post('/pertanyaan/{id}/jawab', [kyaip::class, 'simpanJawaban'])->name('kyai.pertanyaan.simpan');
// });
Route::middleware(['auth', 'role:kyai'])->prefix('kyai')->group(function () {
    Route::get('/pertanyaan', [kyaip::class, 'index'])->name('kyai.pertanyaan.index');
    Route::get('/pertanyaan/{id}/jawab', [kyaip::class, 'jawab'])->name('kyai.pertanyaan.jawab');
    Route::post('/pertanyaan/{id}/jawab', [kyaip::class, 'simpanJawaban'])->name('kyai.pertanyaan.simpan');

    Route::get('/tanya-kyai', [ptn::class, 'create'])->name('pertanyaan.create');
    Route::post('/tanya-kyai', [ptn::class, 'store'])->name('pertanyaan.store');
   // Route::put('/jawaban/{id}', [ptn::class, 'update'])->name('jawaban.update');

});