<x-app-layout>
    <div class="py-12 bg-light min-vh-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold text-dark">Panel Guru SIPI 👋</h2>
                    <p class="text-muted">Kelola konten pembelajaran SMAN 1 Sindangkasih.</p>
                </div>
                <span class="badge bg-primary px-3 py-2 rounded-pill">Mode Administrator</span>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 rounded-3 p-3 text-primary">
                                <span class="fs-2">👨‍🎓</span>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted small uppercase fw-bold">Total Siswa</h6>
                                <h3 class="fw-bold mb-0 text-dark">{{ $total_siswa }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-success bg-opacity-10 rounded-3 p-3 text-success">
                                <span class="fs-2">📚</span>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted small uppercase fw-bold">Materi Publish</h6>
                                <h3 class="fw-bold mb-0 text-dark">{{ $total_materi }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-warning bg-opacity-10 rounded-3 p-3 text-warning">
                                <span class="fs-2">📝</span>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-muted small uppercase fw-bold">Kuis Aktif</h6>
                                <h3 class="fw-bold mb-0 text-dark">{{ $total_kuis }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center border-0">
                            <h5 class="fw-bold mb-0">Materi Terbaru</h5>
                            <button class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 text-muted small text-uppercase">Judul Materi</th>
                                        <th class="text-center text-muted small text-uppercase">Dibuat</th>
                                        <th class="text-end pe-4 text-muted small text-uppercase">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($materi_terbaru as $m)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">{{ $m->judul_materi }}</td>
                                        <td class="text-center small text-muted">{{ $m->created_at->format('d M Y') }}</td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('siswa.materi.show', $m->id) }}" class="btn btn-sm btn-light border" title="Preview">👁️</a>
                                            <button class="btn btn-sm btn-light border" title="Edit">✏️</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted small">Belum ada materi.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary text-white text-center shadow-lg">
                        <h5 class="fw-bold mb-2">Buat Materi Baru</h5>
                        <p class="small opacity-75 mb-4">Tambahkan modul PDF atau Video pembelajaran hari ini.</p>
                        <a href="#" class="btn btn-light w-100 rounded-pill fw-bold py-2 text-primary">
                            + Tambah Materi
                        </a>
                    </div>
                    
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h6 class="fw-bold mb-3 text-dark">Informasi Terakhir</h6>
                        <div class="d-flex align-items-start mb-3">
                            <div class="bg-success rounded-circle mt-1" style="width: 8px; height: 8px; flex-shrink: 0;"></div>
                            <div class="ms-3">
                                <p class="mb-0 small fw-medium">Sistem SIPI Normal</p>
                                <small class="text-muted">Semua layanan berjalan lancar.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>