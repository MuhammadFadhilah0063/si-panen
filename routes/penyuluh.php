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
    Route::prefix('penyuluh')->group(function () {
        Route::middleware('can:penyuluh-access')->group(function () {
            Route::get('dashboard', [AuthController::class, 'dashboardAdmin'])->name('penyuluh.dashboard');
            Route::get('tambah-petani', [AuthController::class, 'tambahpetani'])->name('penyuluh.tambah-petani');

            Route::resource('hasil-panen', HasilPanenController::class)->names('penyuluh.hasil-panen');
            Route::resource('poktan', PoktanController::class)->names('penyuluh.poktan');
            Route::resource('gapoktan', GapoktanController::class)->names('penyuluh.gapoktan');

            Route::get('get-poktan/{id}', [PoktanController::class, 'getPoktanById'])->name('penyuluh.poktan.getPoktanById');
            Route::get('get-gapoktan/{id}', [GapoktanController::class, 'getGapoktanById'])->name('penyuluh.gapoktan.getGapoktanById');
            Route::get('get-kelompok-by-id/{id?}', [KelompokController::class, 'getKelompokById']);

            Route::get('get-kelurahan-by-kecamatan/{id?}', [KecamatanController::class, 'getKelurahanByKecamatan'])->name('penyuluh.getKelurahanByKecamatan');
            Route::get('hasil-panen/daerah/{nama_daerah?}', [HasilPanenController::class, 'showDaerah'])->name('penyuluh.hasil-panen.showDaerah');

            Route::get('get-poktan', [PoktanController::class, 'getPoktan'])->name('penyuluh.poktan.getPoktan');
            Route::get('get-gapoktan', [GapoktanController::class, 'getGapoktan'])->name('penyuluh.gapoktan.getGapoktan');

            Route::get('export', [ExportController::class, 'index'])->name('penyuluh.export.index');
            Route::post('export', [ExportController::class, 'export'])->name('penyuluh.export.export');
            Route::post('export/get-data', [ExportController::class, 'getData']);

            Route::get('profile', [AuthController::class, 'profile'])->name('penyuluh.profile');
            Route::put('profile', [AuthController::class, 'update'])->name('penyuluh.profile.update');

            Route::get('hasil-panen/daerah/{nama_daerah?}/get-total-panen', [HasilPanenController::class, 'getTotalPanen']);
        });
    });
}]);