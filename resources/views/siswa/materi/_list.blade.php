@forelse($materis as $materi)
<div class="col-md-6 col-lg-4" data-aos="fade-up">
    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-card">
        <div class="position-relative">
            <img src="{{ $materi->thumbnail ? asset('storage/'.$materi->thumbnail) : 'https://via.placeholder.com/600x400?text=SIPI+Learning' }}" 
                 class="card-img-top" alt="{{ $materi->judul_materi }}" style="height: 200px; object-fit: cover;">
            <span class="position-absolute top-0 end-0 m-3 badge rounded-pill bg-white text-primary px-3 py-2 shadow-sm" style="font-weight: 700; font-size: 0.75rem;">
                {{ $materi->kategori }}
            </span>
        </div>
        <div class="card-body p-4 d-flex flex-column">
            <h4 class="fw-bold text-dark mb-2" style="font-size: 1.25rem;">{{ $materi->judul_materi }}</h4>
            <p class="text-secondary small flex-grow-1 mb-4">
                {{ Str::limit($materi->deskripsi, 100) }}
            </p>
            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                <div class="small text-muted">
                    📂 {{ $materi->moduls_count }} Modul • 📝 {{ $materi->kuis_count }} Kuis
                </div>
                <a href="{{ route('siswa.materi.show', $materi->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">Mulai</a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center py-5">
    <h5 class="text-muted fw-medium">Materi tidak ditemukan.</h5>
</div>
@endforelse