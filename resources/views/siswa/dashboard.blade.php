<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <div class="mb-5" data-aos="fade-down">
            <h1 class="fw-extrabold text-dark mb-2" style="font-size: 2.8rem; letter-spacing: -0.02em;">
                Selamat Datang, {{ Auth::user()->name }}!
            </h1>
            <p class="text-secondary" style="font-size: 1.2rem; font-weight: 500;">
                Sudah siapkah Anda untuk belajar hal baru hari ini?
            </p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-4 me-3">
                                <span style="font-size: 1.8rem;">🏆</span>
                            </div>
                            <h5 class="fw-bold m-0 text-dark" style="font-size: 1.3rem;">Total Poin Anda</h5>
                        </div>
                        <h2 class="fw-extrabold text-primary mb-3" style="font-size: 3.5rem; letter-spacing: -0.03em;">
                            {{ number_format($score->poin_akumulasi ?? 0) }} 
                            <span class="text-muted fw-medium" style="font-size: 1.2rem;">Pts</span>
                        </h2>
                        <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                            Kumpulkan poin lebih banyak dengan menyelesaikan kuis pada setiap materi.
                        </p>
                        <hr class="my-4 opacity-25">
                        <a href="{{ route('siswa.scoreboard.index') }}" class="text-primary fw-bold text-decoration-none d-flex align-items-center transition-link">
                            Lihat Papan Skor <span class="ms-2">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-info p-3 rounded-4 me-3">
                                <span style="font-size: 1.8rem;">📖</span>
                            </div>
                            <h5 class="fw-bold m-0 text-dark" style="font-size: 1.3rem;">Materi Terupdate</h5>
                        </div>
                        
                        @if($latestMateri)
                            <h4 class="fw-bold text-dark mb-2" style="font-size: 1.6rem;">{{ $latestMateri->judul_materi }}</h4>
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill mb-4" style="font-size: 0.85rem; font-weight: 600;">
                                {{ $latestMateri->kategori }}
                            </span>
                            <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                                {{ Str::limit($latestMateri->deskripsi, 130) }}
                            </p>
                        @else
                            <p class="text-muted flex-grow-1">Belum ada materi yang tersedia saat ini.</p>
                        @endif

                        <hr class="my-4 opacity-25">
                        <a href="{{ route('siswa.materi.index') }}" class="text-info fw-bold text-decoration-none d-flex align-items-center transition-link">
                            Lihat Semua Materi <span class="ms-2">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fw-extrabold { font-weight: 800; }
        .rounded-4 { border-radius: 1.5rem !important; }
        .card { border: 1px solid rgba(0,0,0,0.03) !important; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.06) !important; }
        .transition-link { transition: transform 0.2s ease; }
        .transition-link:hover { transform: translateX(5px); }
    </style>
</x-app-layout>