<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary text-xl">Masuk ke Akun Anda</h2>
                </div>

                <x-auth-session-status class="mb-4 text-center text-success" :status="session('status')" />

                @if ($errors->has('email'))
                    <div class="alert alert-danger py-2 px-3 rounded-3 small mb-4">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input id="email" type="email" name="email" 
                            class="form-control form-control-lg bg-light border-2 shadow-none rounded-3 @error('email') is-invalid @enderror" 
                            placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password" 
                            class="form-control form-control-lg bg-light border-2 shadow-none rounded-3 @error('password') is-invalid @enderror" 
                            placeholder="••••••••" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small text-muted" for="remember">Ingat saya</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-primary text-decoration-none">Lupa password?</a>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3 py-2 shadow-sm">Masuk</button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Sekarang</a></p>
                    </div>

                    <div class="text-center mt-4 border-t pt-3">
                        <a href="/" class="text-muted small text-decoration-none">← Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>