<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\HasilPanenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenyuluhController;
use App\Http\Controllers\PoktanController;
use App\Http\Controllers\GapoktanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KelompokController;

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

Route::get('/', [AuthController::class, 'dashboardGuest'])->name('dashboard');
Route::get('/profil', [AuthController::class, 'profil'])->name('profil');
Route::get('/hasil-panen', [HasilPanenController::class, 'hasilPanenGuest'])->name('hasil-panen');
Route::get('get-hasil-panen/{id?}', [HasilPanenController::class, 'getHasilPanen'])->name('hasil-panen.getHasilPanen');
Route::get('get-penyuluh', [PenyuluhController::class, 'getPenyuluh'])->name('admin.penyuluh.getPenyuluh');

Route::get('get-penyuluh/{id?}', [PenyuluhController::class, 'getPenyuluhById'])->name('admin.penyuluh.getPenyuluhById');
Route::get('get-verifikasi/{id?}', [HasilPanenController::class, 'getVerifikasi'])->name('hasil-panen.getVerifikasi');
Route::put('update-verifikasi/{id?}', [HasilPanenController::class, 'updateVerifikasi'])->name('hasil-panen.updateVerifikasi');
Route::get('berita/{slug?}', [BeritaController::class, 'show'])->name('berita.show');

Route::delete('delete-image/{id}', [HasilPanenController::class, 'destroyImage'])->name('destroyImage');

// login route
Route::group(['middleware' => 'guest', 'controller' => AuthController::class], function () {
    Route::get('login', 'index')->name('login');
    Route::post('login', 'login')->name('login.store');
});

Route::middleware('auth')->group([function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    

    //Route for admin
    Route::prefix('admin')->group(function () {
        Route::middleware('can:admin-access')->group(function () {
            Route::get('dashboard', [AuthController::class, 'dashboardAdmin'])->name('admin.dashboard');

            Route::resource('hasil-panen', HasilPanenController::class)->names('admin.hasil-panen');
            Route::resource('kelurahan', KelurahanController::class)->names('admin.kelurahan');
            Route::resource('kecamatan', KecamatanController::class)->names('admin.kecamatan');
            Route::resource('user-config', UserController::class)->names('admin.user-config');
            Route::resource('penyuluh', PenyuluhController::class)->names('admin.penyuluh');
            Route::resource('poktan', PoktanController::class)->names('admin.poktan');
            Route::resource('gapoktan', GapoktanController::class)->names('admin.gapoktan');
            Route::resource('kelompok', KelompokController::class)->names('admin.kelompok');
            Route::get('get-kelompok-by-id/{id?}', [KelompokController::class, 'getKelompokById']);
            Route::get('get-Poktan', [PoktanController::class, 'getPoktan'])->name('admin.poktan.getPoktan');
            Route::get('get-Gapoktan', [GapoktanController::class, 'getGapoktan'])->name('admin.gapoktan.getGapoktan');
            Route::get('get-poktan/{id}', [PoktanController::class, 'getPoktanById'])->name('admin.poktan.getPoktanById');
            Route::get('get-gapoktan/{id}', [GapoktanController::class, 'getGapoktanById'])->name('admin.gapoktan.getGapoktanById');
            Route::get('get-kelurahan-by-kecamatan/{id?}', [KecamatanController::class, 'getKelurahanByKecamatan'])->name('admin.getKelurahanByKecamatan');

            Route::get('gapoktan/get-kelurahan/{id}', [KelurahanController::class, 'getKelurahanByKecamatan']);
            Route::get('poktan/get-kelurahan/{id}', [KelurahanController::class, 'getKelurahanByKecamatan']);
            
            Route::get('hasil-panen/daerah/{nama_daerah?}', [HasilPanenController::class, 'showDaerah'])->name('admin.hasil-panen.showDaerah');

            Route::get('hasil-panen/daerah/{nama_daerah?}/get-total-panen', [HasilPanenController::class, 'getTotalPanen']);

            Route::get('get-kecamatan/{id?}', [KecamatanController::class, 'getKecamatan'])->name('admin.kecamatan.getKecamatan');
            Route::get('get-kelurahan/{id?}', [KelurahanController::class, 'getKelurahan'])->name('admin.kelurahan.getKelurahan');

            Route::get('export', [ExportController::class, 'index'])->name('admin.export.index');
            Route::post('export', [ExportController::class, 'export'])->name('admin.export.export');
            Route::post('export/get-data', [ExportController::class, 'getData']);

            Route::get('profile', [AuthController::class, 'profile'])->name('admin.profile');
            Route::put('profile', [AuthController::class, 'update'])->name('admin.profile.update');

            Route::resource('pegawai', PegawaiController::class)->names('admin.pegawai');
            Route::resource('jabatan', JabatanController::class)->names('admin.jabatan');

            Route::resource('berita', BeritaController::class)->names('admin.berita')->parameters([
                'berita' => 'berita'
            ]);
            Route::get('get-berita/{id?}', [BeritaController::class, 'getBeritaById'])->name('admin.berita.getBeritaById');

            Route::post('get-users', [UserController::class, 'getUsersByAkun']);
        });
    });
}]);

require_once "penyuluh.php";
require_once "petani.php";
require_once "kabid.php";
// Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


// Route::group(['middleware' => 'auth', 'prefix' => 'admin/', 'as' => 'admin.'], function () {
//     Route::get('dashboard', [AuthController::class, 'dashboardAdmin'])->name('dashboard');

//     Route::resource('hasil-panen', HasilPanenController::class)->names('hasil-panen');
//     Route::resource('kelurahan', KelurahanController::class)->names('kelurahan');
//     Route::resource('kecamatan', KecamatanController::class)->names('kecamatan');
//     Route::resource('user-config', UserController::class)->names('user-config');

//     Route::get('get-kelurahan-by-kecamatan/{id?}', [KecamatanController::class, 'getKelurahanByKecamatan'])->name('getKelurahanByKecamatan');

//     Route::get('hasil-panen/daerah/{nama_daerah?}', [HasilPanenController::class, 'showDaerah'])->name('hasil-panen.showDaerah');

//     Route::get('get-kecamatan/{id?}', [KecamatanController::class, 'getKecamatan'])->name('kecamatan.getKecamatan');
//     Route::get('get-kelurahan/{id?}', [KelurahanController::class, 'getKelurahan'])->name('kelurahan.getKelurahan');

//     Route::get('export', [ExportController::class, 'index'])->name('export.index');
//     Route::post('export', [ExportController::class, 'export'])->name('export.export');

//     Route::get('profile', [AuthController::class, 'profile'])->name('profile');
//     Route::put('profile', [AuthController::class, 'update'])->name('profile.update');

// });