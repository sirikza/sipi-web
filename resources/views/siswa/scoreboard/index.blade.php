<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <div class="mb-5" data-aos="fade-down">
            <h1 class="fw-extrabold text-dark mb-2" style="font-size: 2.8rem; letter-spacing: -0.02em;">Papan Skor Global</h1>
            <p class="text-secondary" style="font-size: 1.2rem; font-weight: 500;">Pantau peringkatmu dan terus tingkatkan prestasimu!</p>
        </div>

        <div class="row g-4 mb-5 align-items-end">
            @foreach($rankings->take(3) as $index => $rank)
                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                    <div class="card border-0 shadow-sm rounded-4 text-center {{ $index == 0 ? 'bg-primary text-white p-4 mb-3' : 'bg-white p-3' }}" 
                         style="{{ $index == 0 ? 'transform: translateY(-20px); z-index: 10;' : '' }}">
                        <div class="card-body">
                            <div class="mb-3 position-relative d-inline-block">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" 
                                     style="width: 100px; height: 100px; background-color: {{ $index == 0 ? 'rgba(255,255,255,0.2)' : '#f0f9ff' }}; border: 4px solid {{ $index == 0 ? 'rgba(255,255,255,0.3)' : 'white' }};">
                                    <span class="fw-bold" style="font-size: 2.2rem; color: {{ $index == 0 ? 'white' : '#2563eb' }};">
                                        @php
                                            $nameParts = explode(' ', $rank->user->name);
                                            echo strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
                                        @endphp
                                    </span>
                                </div>
                                <span class="position-absolute bottom-0 end-0" style="font-size: 2rem;">
                                    {{ $index == 0 ? '🥇' : ($index == 1 ? '🥈' : '🥉') }}
                                </span>
                            </div>
                            <h4 class="fw-bold mb-1">{{ $rank->user->name }}</h4>
                            <p class="{{ $index == 0 ? 'text-white-50' : 'text-muted' }} small mb-3">{{ $rank->user->kelas ?? 'Umum' }}</p>
                            <h3 class="fw-extrabold mb-0">{{ number_format($rank->poin_akumulasi) }} <span style="font-size: 1rem; font-weight: 500;">Pts</span></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5" data-aos="fade-up">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8fafc;">
                        <tr>
                            <th class="py-4 ps-4 text-secondary fw-bold" style="font-size: 0.9rem; text-transform: uppercase;">Posisi</th>
                            <th class="py-4 text-secondary fw-bold" style="font-size: 0.9rem; text-transform: uppercase;">Siswa</th>
                            <th class="py-4 text-secondary fw-bold" style="font-size: 0.9rem; text-transform: uppercase;">Kelas</th>
                            <th class="py-4 pe-4 text-end text-secondary fw-bold" style="font-size: 0.9rem; text-transform: uppercase;">Total Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rankings as $index => $rank)
                        <tr class="{{ $rank->user_id == auth()->id() ? 'bg-primary bg-opacity-5' : '' }}">
                            <td class="py-4 ps-4">
                                <span class="fw-bold {{ $index < 3 ? 'text-primary' : 'text-secondary' }}" style="font-size: 1.1rem;">
                                    #{{ $index + 1 }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-primary me-3" 
                                         style="width: 45px; height: 45px; font-size: 0.9rem; border: 1px solid #e2e8f0;">
                                        {{ strtoupper(substr($rank->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $rank->user->name }}</div>
                                        @if($rank->user_id == auth()->id())
                                            <span class="badge rounded-pill bg-primary px-2" style="font-size: 0.65rem;">SAYA</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 text-secondary fw-medium">{{ $rank->user->kelas ?? '-' }}</td>
                            <td class="py-4 pe-4 text-end">
                                <span class="fw-extrabold text-primary" style="font-size: 1.2rem;">{{ number_format($rank->poin_akumulasi) }}</span>
                                <span class="text-muted small ms-1">Pts</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada data skor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .fw-extrabold { font-weight: 800; }
        .rounded-4 { border-radius: 1.5rem !important; }
        .card { border: 1px solid rgba(0,0,0,0.03) !important; }
        .table tbody tr { transition: all 0.2s ease; }
        .table tbody tr:hover { background-color: #f1f5f9; }
    </style>
</x-app-layout>