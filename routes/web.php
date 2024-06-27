<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PermohonanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/warga', [WargaController::class, 'index'])->name('dashboard.warga');

    // Warga routes
    Route::resource('warga', WargaController::class);

    // Permohonan routes
    Route::resource('permohonan', PermohonanController::class);

    // History & Status routes
    Route::get('permohonan/history', [PermohonanController::class, 'history'])->name('permohonan.history');
    Route::get('permohonan/status/{id}', [PermohonanController::class, 'status'])->name('permohonan.status');
});

require __DIR__.'/auth.php';
