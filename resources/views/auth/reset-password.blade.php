<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary text-xl">Update Password</h3>
                    <p class="text-muted small">Silakan buat password baru Anda.</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold ">Email</label>
                        <input id="email" type="email" name="email" class="form-control bg-light border-0 shadow-none rounded-3" value="{{ old('email', $request->email) }}" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold ">Password Baru</label>
                        <input id="password" type="password" name="password" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="••••••••" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold ">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control bg-light border-0 shadow-none rounded-3" placeholder="••••••••" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold rounded-3 py-2">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>