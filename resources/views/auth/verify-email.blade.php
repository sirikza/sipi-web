<x-guest-layout>
    <div class="min-vh-100 d-flex align-items-center justify-content-center bg-primary bg-opacity-10">
        <div class="card shadow-sm border-0 rounded-4" style="width: 100%; max-width: 450px;">
            <div class="card-body p-5 text-center">
                <div class="mb-4">
                    <h3 class="fw-bold text-primary text-xl">Verifikasi Email</h3>
                    <p class="text-muted small">Terima kasih telah mendaftar! Silakan cek email Anda untuk melakukan verifikasi sebelum memulai belajar.</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success small mb-4">Link verifikasi baru telah dikirim!</div>
                @endif

                <div class="d-grid gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary fw-bold rounded-3 w-100 py-2">Kirim Ulang Email Verifikasi</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-muted small text-decoration-none">Keluar dari Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>