<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ModulController;
use App\Http\Controllers\Api\KuisController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// --- RUTE TERPROTEKSI (Wajib membawa token) ---
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Ambil daftar user (GET)
    Route::get('/users', [UserController::class, 'index']);

    // TAMBAHKAN INI: Tambah user baru (POST)
    Route::post('/users', [UserController::class, 'store']);

    // Update user (PUT)
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Hapus user (DELETE)
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Route Auth
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rute CRUD Materi
    Route::get('/materi', [MateriController::class, 'index']);
    Route::post('/materi', [MateriController::class, 'store']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);

    // Rute Manajemen User
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Endpoint khusus Guru (Proteksi API)
Route::middleware('auth:sanctum')->prefix('guru')->group(function () {
    Route::post('/materi', [MateriController::class, 'store']);
    Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);

    // Rute Modul
    Route::post('/modul', [ModulController::class, 'store']);
    Route::put('/modul/{id}', [ModulController::class, 'update']);
    Route::delete('/modul/{id}', [ModulController::class, 'destroy']);

    // Rute Kuis
    Route::post('/kuis', [KuisController::class, 'store']);
    Route::put('/kuis/{id}', [KuisController::class, 'update']);
    Route::delete('/kuis/{id}', [KuisController::class, 'destroy']);
});
