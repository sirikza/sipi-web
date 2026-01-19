<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 1. Daftarkan Alias Middleware Role
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // 2. Atur Logika Pengalihan (Redirect) Otomatis
        $middleware->redirectTo(
            guests: '/login', // Jika belum login, lempar ke sini
            users: function () {
                // Jika sudah login, cek level_akses untuk menentukan dashboard
                $user = Auth::user();
                if ($user->level_akses === 'guru') {
                    return '/guru/dashboard';
                }
                return '/siswa/dashboard';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
