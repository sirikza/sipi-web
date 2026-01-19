<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            // Method ini akan melempar ValidationException jika login gagal
            $request->authenticate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Jika gagal, kembali ke halaman login dengan pesan error kustom
            return redirect()->back()
                ->withErrors(['email' => 'Email atau password yang Anda masukkan salah.'])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Pastikan arah redirect sesuai role
        if ($user->level_akses === 'guru') {
            return redirect()->intended(route('guru.dashboard'));
        }

        return redirect()->intended(route('siswa.dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
