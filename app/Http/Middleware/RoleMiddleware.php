<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // 2. Cek apakah level_akses sesuai dengan parameter di route
        if ($user->level_akses !== $role) {
            // Jika user memaksa akses rute yang bukan haknya, arahkan ke dashboard masing-masing
            if ($user->level_akses === 'guru') {
                return redirect()->route('guru.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman siswa.');
            }

            if ($user->level_akses === 'siswa') {
                return redirect()->route('siswa.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman guru.');
            }

            // Jika role tidak dikenal sama sekali
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}
