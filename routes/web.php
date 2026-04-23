<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterTutorialController;
use App\Http\Controllers\TutorialDetailController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\FinishedController;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Rute Publik (Tanpa Login)

Route::get('/presentation/{url_presentation}', [PresentationController::class, 'show'])->name('presentation.show');
Route::get('/finished/{url_finished}', [FinishedController::class, 'show'])->name('finished.show');
// Webservice API Server (Spesifikasi 10)
Route::get('/api/{kode_matkul}', [ApiController::class, 'getTutorialByMatkul']);
// --- RUTE YANG DIPROTEKSI LOGIN ---
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/master-tutorial', [MasterTutorialController::class, 'index'])->name('master.index');
    Route::get('/master-tutorial/create', [MasterTutorialController::class, 'create'])->name('master.create');
    Route::post('/master-tutorial', [MasterTutorialController::class, 'store'])->name('master.store');
    // Tambahan Route untuk Delete Master Tutorial
    Route::delete('/master-tutorial/{id}', [MasterTutorialController::class, 'destroy'])->name('master.destroy');

    // Tambahan Route untuk Delete Detail Tutorial
    Route::delete('/details/{id}', [TutorialDetailController::class, 'destroy'])->name('details.destroy');
    Route::get('/master-tutorial/{id}/edit', [MasterTutorialController::class, 'edit'])->name('master.edit');
    Route::put('/master-tutorial/{id}', [MasterTutorialController::class, 'update'])->name('master.update');

   // Rute untuk Manajemen Detail Tutorial
    Route::get('/master-tutorial/{master_id}/details', [TutorialDetailController::class, 'index'])->name('details.index');
    Route::get('/master-tutorial/{master_id}/details/create', [TutorialDetailController::class, 'create'])->name('details.create');
    Route::post('/master-tutorial/{master_id}/details', [TutorialDetailController::class, 'store'])->name('details.store');
    Route::post('/details/{id}/toggle', [TutorialDetailController::class, 'toggleStatus'])->name('details.toggle');
    // Tambahan Route untuk Edit Detail Tutorial
    Route::get('/details/{id}/edit', [TutorialDetailController::class, 'edit'])->name('details.edit');
    Route::put('/details/{id}', [TutorialDetailController::class, 'update'])->name('details.update');
});