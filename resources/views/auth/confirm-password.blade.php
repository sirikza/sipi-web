<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span style="font-size: 1.5rem;">🔒</span>
                    </div>
                    <h3 class="fw-bold text-primary text-xl">Konfirmasi Akses</h3>
                    <p class="text-muted small">Ini adalah area aman. Silakan konfirmasi password Anda sebelum melanjutkan.</p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold ">Password</label>
                        <input id="password" type="password" name="password" 
                            class="form-control bg-light border-0 shadow-none rounded-3 py-2" 
                            placeholder="••••••••" 
                            required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold rounded-3 py-2 shadow-sm">
                            Konfirmasi Password
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ url()->previous() }}" class="small text-muted text-decoration-none">← Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>