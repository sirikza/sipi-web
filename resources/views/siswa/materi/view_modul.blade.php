<x-app-layout>
    <div class="container-fluid p-0 flex-grow-1 bg-dark min-vh-100 d-flex flex-column overflow-hidden">
        <div class="bg-white border-bottom p-3 shadow-sm d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <a href="{{ route('siswa.materi.show', $modul->materi_id) }}" 
                   class="btn btn-light rounded-circle me-3 text-decoration-none d-flex align-items-center justify-content-center" 
                   style="width: 40px; height: 40px;">
                    <span class="fs-5">⬅️</span>
                </a>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">{{ $modul->judul_modul }}</h5>
                    <small class="text-muted fw-medium">
                        {{ $modul->materi->judul_materi }} • 
                        <span class="text-primary">{{ strtoupper($modul->tipe_konten) }}</span>
                    </small>
                </div>
            </div>
            <div class="d-none d-md-block">
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                    Mode Belajar Fokus
                </span>
            </div>
        </div>

        <div class="content-viewer flex-grow-1 d-flex justify-content-center align-items-center bg-black position-relative overflow-hidden">
            @if($modul->tipe_konten == 'Video')
                <div class="container py-4">
                    <div class="ratio ratio-16x9 shadow-2xl rounded-4 overflow-hidden bg-black mx-auto" style="max-width: 1000px; border: 1px solid #333;">
                        @if(str_contains($modul->konten, 'youtube.com') || str_contains($modul->konten, 'youtu.be'))
                            @php
                                if (str_contains($modul->konten, 'v=')) {
                                    $videoId = explode('v=', $modul->konten)[1];
                                    $videoId = explode('&', $videoId)[0];
                                } else {
                                    $videoId = last(explode('/', $modul->konten));
                                }
                                $embedUrl = "https://www.youtube.com/embed/" . $videoId . "?rel=0&modestbranding=1";
                            @endphp
                            <iframe src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        @else
                            <video controls crossorigin playsinline class="w-100 h-100">
                                <source src="{{ str_contains($modul->konten, 'http') ? $modul->konten : asset('storage/' . $modul->konten) }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutaran video ini.
                            </video>
                        @endif
                    </div>
                </div>
            @else
                <div class="w-100 h-100 bg-secondary">
                    @php
                        // Logika Penentuan URL PDF
                        $pdfUrl = str_contains($modul->konten, 'http') 
                                  ? $modul->konten 
                                  : asset('storage/' . $modul->konten);
                    @endphp
                    
                    <embed 
                        src="{{ $pdfUrl }}#toolbar=1&navpanes=0&scrollbar=1" 
                        type="application/pdf" 
                        width="100%" 
                        height="100%" 
                        style="border: none;"
                    >
                        <div class="bg-dark text-white text-center p-4 d-flex flex-column justify-content-center align-items-center overflow-auto" style="height: calc(100vh - 82px); min-height: 400px;">
                            <div class="mb-3" style="font-size: 3rem;">📄</div>
                            <h5 class="mb-2">Pratinjau PDF tidak tersedia</h5>
                            <p class="text-secondary small mb-4 px-3" style="max-width: 400px;">
                                Browser Anda mungkin memblokir pratinjau otomatis. Anda dapat membuka file melalui link di bawah.
                            </p>
                            <div class="d-flex flex-column flex-sm-row gap-2 pb-4">
                                <a href="{{ $pdfUrl }}" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold shadow">Buka di Tab Baru</a>
                                <a href="{{ $pdfUrl }}" download class="btn btn-outline-light rounded-pill px-4 fw-bold">Unduh PDF</a>
                            </div>
                        </div>
                    </embed>
                </div>
            @endif
        </div>
    </div>

    <style>
        footer { display: none !important; }
        body { background-color: #000 !important; overflow: hidden; height: 100vh; }
        .content-viewer { height: calc(100vh - 82px); }
        .overflow-auto { overflow-y: auto !important; -webkit-overflow-scrolling: touch; }
        .btn-light { border: 1px solid #eee; transition: all 0.3s ease; }
        .btn-light:hover { transform: scale(1.1); background-color: #f8fafc; }
        .shadow-2xl { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7); }
        iframe, video { width: 100%; height: 100%; object-fit: contain; }
    </style>
</x-app-layout>