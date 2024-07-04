<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PoktanController;
use App\Http\Controllers\GapoktanController;
use App\Http\Controllers\HasilPanenController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelompokController;

Route::middleware('auth')->group([function () {
    //Route for admin
    Route::prefix('petani')->group(function () {
        Route::middleware('can:petani-access')->group(function () {
            Route::get('dashboard', [AuthController::class, 'dashboardAdmin'])->name('petani.dashboard');
            Route::get('tambah-petani', [AuthController::class, 'tambahpetani'])->name('petani.tambah-petani');

            // Route::resource('hasil-panen', HasilPanenController::class)->names('penyuluh.hasil-panen');
            Route::resource('poktan', PoktanController::class)->names('petani.poktan');
            Route::resource('gapoktan', GapoktanController::class)->names('petani.gapoktan');
            Route::resource('kelompok', KelompokController::class)->names('admin.kelompok');
            Route::get('get-kelompok-by-id/{id?}', [KelompokController::class, 'getKelompokById']);

            Route::get('get-poktan/{id?}', [PoktanController::class, 'getPoktanById'])->name('petani.poktan.getPoktanById');
            Route::get('get-gapoktan/{id?}', [GapoktanController::class, 'getGapoktanById'])->name('petani.gapoktan.getGapoktanById');

            Route::get('get-kelurahan-by-kecamatan/{id?}', [KecamatanController::class, 'getKelurahanByKecamatan'])->name('petani.getKelurahanByKecamatan');
            
            // Route::get('hasil-panen/daerah/{nama_daerah?}', [HasilPanenController::class, 'showDaerah'])->name('penyuluh.hasil-panen.showDaerah');

            // Route::get('export', [ExportController::class, 'index'])->name('penyuluh.export.index');
            // Route::post('export', [ExportController::class, 'export'])->name('penyuluh.export.export');

            // Route::get('profile', [AuthController::class, 'profile'])->name('penyuluh.profile');
            // Route::put('profile', [AuthController::class, 'update'])->name('penyuluh.profile.update');
        });
    });
}]);

