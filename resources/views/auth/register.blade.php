<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 450px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary text-xl">Daftar Akun Baru</h2>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input id="name" type="text" name="name" class="form-control bg-light border-2 shadow-none rounded-3" placeholder="Masukkan nama lengkap..." required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" type="email" name="email" class="form-control bg-light border-2 shadow-none rounded-3" placeholder="nama@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password" class="form-control bg-light border-2 shadow-none rounded-3" placeholder="Minimal 8 karakter" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-light border-2 shadow-none rounded-3" placeholder="Ulangi password" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold rounded-3 py-2 shadow-sm">Daftar Akun</button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a></p>
                    </div>

                    <div class="text-center mt-4">
                        <a href="/" class="text-primary fw-bold text-decoration-none">Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>