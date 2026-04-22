<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterTutorialController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE YANG DIPROTEKSI LOGIN ---
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/master-tutorial', [MasterTutorialController::class, 'index'])->name('master.index');
    Route::get('/master-tutorial/create', [MasterTutorialController::class, 'create'])->name('master.create');
    Route::post('/master-tutorial', [MasterTutorialController::class, 'store'])->name('master.store');
});