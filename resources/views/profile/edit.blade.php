<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <div class="mb-5" data-aos="fade-down">
            <h1 class="fw-extrabold text-dark mb-2" style="font-size: 2.8rem; letter-spacing: -0.02em;">Profil Saya</h1>
            <p class="text-secondary" style="font-size: 1.2rem; font-weight: 500;">Kelola informasi akun dan pengaturan keamanan Anda.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-right">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                    <div class="card-body">
                        <div class="mb-4 position-relative d-inline-block">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 120px; height: 120px;">
                                <span style="font-size: 3.5rem;">👤</span>
                            </div>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h4>
                        <span class="badge rounded-pill bg-info bg-opacity-10 text-info px-3 py-2 mb-3" style="font-weight: 600;">
                            Siswa - {{ Auth::user()->kelas ?? 'Umum' }}
                        </span>
            
                        @if(Auth::user()->tanggal_lahir)
                        <p class="text-muted small mb-0">
                            🎂 {{ \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->translatedFormat('d F Y') }}
                        </p>
                        @endif
                        <p class="text-muted small">Terdaftar sejak {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                                🔑
                            </div>
                            <h5 class="fw-bold m-0" style="font-size: 1.3rem;">Informasi Profil</h5>
                        </div>
                        
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                                🛡️
                            </div>
                            <h5 class="fw-bold m-0" style="font-size: 1.3rem;">Keamanan Akun</h5>
                        </div>

                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fw-extrabold { font-weight: 800; }
        .rounded-4 { border-radius: 1.5rem !important; }
        .card { border: 1px solid rgba(0,0,0,0.03) !important; }
        /* Styling untuk form bawaan Breeze agar selaras */
        input { 
            border-radius: 0.75rem !important; 
            border: 1px solid #e2e8f0 !important;
            padding: 0.75rem 1rem !important;
        }
        button[type="submit"] {
            border-radius: 0.75rem !important;
            padding: 0.75rem 1.5rem !important;
            font-weight: 600 !important;
            background-color: #2563eb !important;
        }
    </style>
</x-app-layout>