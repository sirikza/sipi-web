<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary text-xl">Lupa Password?</h3>
                    <p class="text-muted small">Masukkan email Anda untuk menerima link reset password.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input id="email" type="email" name="email" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="nama@email.com" required autofocus>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold rounded-3 py-2">Kirim Link Reset</button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="small text-primary text-decoration-none">Kembali ke Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>