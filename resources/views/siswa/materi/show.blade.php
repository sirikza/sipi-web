<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.materi.index') }}" class="text-decoration-none text-primary fw-semibold">Materi Ajar</a>
                </li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $materi->judul_materi }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4" data-aos="fade-right">
                    <div class="position-relative">
                        <img src="{{ $materi->thumbnail ? asset('storage/'.$materi->thumbnail) : 'https://via.placeholder.com/800x400' }}" 
                             class="img-fluid w-100" alt="Thumbnail" style="height: 400px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 p-4 bg-gradient-to-t from-black/60 to-transparent w-100 text-white">
                             <span class="badge rounded-pill bg-white text-primary px-3 py-2 fw-bold mb-2">
                                {{ $materi->kategori }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="fw-extrabold text-dark m-0" style="font-size: 2.2rem; letter-spacing: -0.02em;">
                                {{ $materi->judul_materi }}
                            </h2>
                        </div>
                        <p class="text-secondary mb-0" style="font-size: 1.1rem; line-height: 1.8; text-align: justify;">
                            {{ $materi->deskripsi }}
                        </p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4" data-aos="fade-up">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">💬</div>
                            <h4 class="fw-extrabold text-dark m-0">Forum Diskusi</h4>
                        </div>

                        <form action="{{ route('forum.store', $materi->id) }}" method="POST" class="mb-5">
                            @csrf
                            <div class="form-group mb-3">
                                <textarea name="pesan" class="form-control rounded-4 border-light p-3 shadow-sm" 
                                          rows="3" placeholder="Tanyakan atau diskusikan sesuatu tentang materi ini..." required></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>

                        <div class="discussion-list">
                            @php
                                $discussions = \App\Models\Discussion::where('materi_id', $materi->id)
                                                ->with('user')
                                                ->latest()
                                                ->get();
                            @endphp

                            @forelse($discussions as $chat)
                            <div class="d-flex mb-4 p-3 rounded-4 {{ $chat->user->role == 'guru' ? 'bg-primary bg-opacity-5 border-start border-primary border-4' : 'bg-light' }}">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center fw-bold text-primary" 
                                         style="width: 45px; height: 45px; border: 1px solid #eef2ff;">
                                        @php
                                            $nameParts = explode(' ', $chat->user->name);
                                            echo strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                                        @endphp
                                    </div>
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold mb-0 text-dark">
                                            {{ $chat->user->name }}
                                            @if($chat->user->role == 'guru')
                                                <span class="badge bg-primary ms-1" style="font-size: 0.6rem;">GURU</span>
                                            @endif
                                        </h6>
                                        <small class="text-muted" style="font-size: 0.7rem;">{{ $chat->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="text-secondary mb-0 small" style="line-height: 1.5;">{{ $chat->pesan }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <p class="text-muted small italic">Belum ada diskusi. Ayo mulai bertanya!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">📚</div>
                            <h5 class="fw-bold text-dark m-0">Daftar Modul</h5>
                        </div>
                        
                        <div class="modul-list">
                            @forelse($materi->moduls as $index => $modul)
                            <div class="d-flex align-items-center p-3 rounded-4 bg-light border border-transparent hover-border-primary transition-all mb-3">
                                <div class="bg-white shadow-sm rounded-3 d-flex align-items-center justify-content-center me-3 fw-bold text-primary" style="min-width: 40px; height: 40px;">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h6 class="fw-bold text-dark mb-1 text-truncate" style="font-size: 0.9rem;">{{ $modul->judul_modul }}</h6>
                                    <span class="badge {{ $modul->tipe_konten == 'Video' ? 'bg-danger' : 'bg-warning' }} bg-opacity-10 {{ $modul->tipe_konten == 'Video' ? 'text-danger' : 'text-warning' }} py-1 px-2" style="font-size: 0.65rem; font-weight: 700;">
                                        {{ strtoupper($modul->tipe_konten) }}
                                    </span>
                                </div>
                                <a href="{{ route('siswa.modul.view', $modul->id) }}" class="btn btn-white shadow-sm rounded-circle ms-2 p-0 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                    <span style="font-size: 0.8rem;">▶️</span>
                                </a>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <p class="text-muted small italic mb-0">Modul belum tersedia untuk materi ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4">
                    <div class="card-body text-center">
                        @if(isset($hasilKuis) && $hasilKuis)
                            <div class="mb-3 fs-1">🏆</div>
                            <h4 class="fw-bold mb-2">Kuis Selesai!</h4>
                            <p class="small text-white-50 mb-4">Anda telah menyelesaikan kuis ini. Berikut adalah skor Anda:</p>
                            
                            <div class="bg-white rounded-4 p-3 mb-3 shadow-sm">
                                <h1 class="text-primary fw-extrabold mb-0" style="font-size: 3rem;">
                                    {{ number_format($hasilKuis->total_skor, 0) }}
                                </h1>
                                <span class="badge {{ $hasilKuis->status == 'Lulus' ? 'bg-success' : 'bg-danger' }} px-3 py-2 rounded-pill mt-2">
                                    {{ strtoupper($hasilKuis->status) }}
                                </span>
                            </div>
                            <p class="small text-white-50 mb-0 italic" style="font-size: 0.7rem;">*Kuis hanya dapat dikerjakan satu kali.</p>
                        @else
                            <div class="mb-3 fs-1">🎯</div>
                            <h4 class="fw-bold mb-2">Uji Pemahamanmu</h4>
                            <p class="small text-white-50 mb-4">Selesaikan kuis untuk mendapatkan poin dan masuk ke Papan Skor.</p>
                            
                            @if($materi->kuis->count() > 0)
                                <button type="button" class="btn btn-light w-100 rounded-pill fw-extrabold py-3 text-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#quizAlertModal">
                                    Mulai Kuis Sekarang
                                </button>
                            @else
                                <button class="btn btn-light w-100 rounded-pill fw-bold py-3 disabled opacity-50">Kuis Belum Tersedia</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quizAlertModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-body p-5 text-center">
                    <div class="mb-4 d-inline-block p-4 bg-warning bg-opacity-10 rounded-circle text-warning fs-1">
                        ⚠️
                    </div>
                    <h3 class="fw-extrabold text-dark mb-3">Peringatan Penting!</h3>
                    <p class="text-secondary mb-4 px-md-3">
                        Kuis ini hanya dapat dikerjakan <strong>satu kali</strong>. Pastikan Anda sudah mempelajari semua modul dengan teliti sebelum melanjutkan.
                    </p>
                    <div class="d-grid gap-3">
                        <a href="{{ route('siswa.kuis.show', $materi->id) }}" class="btn btn-primary rounded-pill py-3 fw-bold shadow">
                            Ya, Saya Siap Mulai
                        </a>
                        <button type="button" class="btn btn-light rounded-pill py-3 fw-bold text-muted" data-bs-dismiss="modal">
                            Kembali Belajar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fw-extrabold { font-weight: 800; }
        .rounded-4 { border-radius: 1.5rem !important; }
        .bg-light { background-color: #f8fafc !important; }
        .hover-border-primary:hover { 
            border-color: #2563eb !important; 
            background-color: #ffffff !important; 
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            transform: scale(1.02);
        }
        .btn-white { background-color: white; border: none; color: #2563eb; }
        .btn-white:hover { background-color: #f1f5f9; transform: rotate(10deg); }
        .transition-all { transition: all 0.3s ease-in-out; }
    </style>
</x-app-layout>