<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\MateriController;
use App\Http\Controllers\Siswa\KuisController;
use App\Http\Controllers\Siswa\ScoreboardController;
use App\Http\Controllers\Guru\GuruController as GuruDashboard;

// 1. Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Global Auth Routes (Dapat diakses Guru & Siswa)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Forum Diskusi
    Route::post('/forum/{materi_id}/store', [ForumController::class, 'store'])->name('forum.store');
});

// 3. Area Khusus Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    // Berikan nama rute yang spesifik
    Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');

    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');
    Route::get('/materi/modul/{id}', [MateriController::class, 'viewModul'])->name('modul.view');

    Route::get('/kuis/{materi_id}', [KuisController::class, 'show'])->name('kuis.show');
    Route::post('/kuis/{materi_id}/submit', [KuisController::class, 'submit'])->name('kuis.submit');

    Route::get('/scoreboard', [ScoreboardController::class, 'index'])->name('scoreboard.index');
});

// 4. Area Khusus Guru
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    // Berikan nama rute yang spesifik
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

    // Ke depannya kita akan tambah route materi di sini
    // Route::resource('materi', \App\Http\Controllers\Guru\MateriController::class);
});

// PENTING: Jangan membuat Route::get('/dashboard') di sini!
// Biarkan bootstrap/app.php yang menangani pengalihan berdasarkan level_akses.

require __DIR__ . '/auth.php';
