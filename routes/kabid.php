<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PoktanController;
use App\Http\Controllers\GapoktanController;
use App\Http\Controllers\HasilPanenController;
use App\Http\Controllers\PenyuluhController;
use App\Http\Controllers\PegawaiController;

Route::middleware('auth')->group([function () {
    //Route for admin
    Route::prefix('kabid')->group(function () {
        Route::middleware('can:kabid-access')->group(function () {
            Route::get('dashboard', [AuthController::class, 'dashboardAdmin'])->name('kabid.dashboard');

            Route::resource('hasil-panen', HasilPanenController::class)->names('kabid.hasil-panen');
            Route::resource('poktan', PoktanController::class)->names('kabid.poktan');
            Route::resource('gapoktan', GapoktanController::class)->names('kabid.gapoktan');
            Route::resource('penyuluh', PenyuluhController::class)->names('kabid.penyuluh');

            // Route::get('get-poktan/{id?}', [PoktanController::class, 'getPoktanById'])->name('petani.poktan.getPoktanById');
            // Route::get('get-gapoktan/{id?}', [GapoktanController::class, 'getGapoktanById'])->name('petani.gapoktan.getGapoktanById');
            
            Route::get('hasil-panen/daerah/{nama_daerah?}', [HasilPanenController::class, 'showDaerah'])->name('kabid.hasil-panen.showDaerah');

            Route::get('export', [ExportController::class, 'index'])->name('kabid.export.index');
            Route::post('export', [ExportController::class, 'export'])->name('kabid.export.export');
            Route::post('export/get-data', [ExportController::class, 'getData']);

            Route::resource('pegawai', PegawaiController::class)->names('kabid.pegawai');
            Route::get('profile', [AuthController::class, 'profile'])->name('kabid.profile');
            Route::put('profile', [AuthController::class, 'update'])->name('kabid.profile.update');

            Route::get('hasil-panen/daerah/{nama_daerah?}/get-total-panen', [HasilPanenController::class, 'getTotalPanen']);

            // Route::get('profile', [AuthController::class, 'profile'])->name('penyuluh.profile');
            // Route::put('profile', [AuthController::class, 'update'])->name('penyuluh.profile.update');
        });
    });
}]);