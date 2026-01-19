<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIPI') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            /* Reset & Base Typography */
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
                background-color: #f8fafc;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                color: #1e293b;
            }

            /* Global Utility Classes */
            .fw-extrabold { font-weight: 800; }
            .bg-primary { background-color: #2563eb !important; }
            .text-primary { color: #2563eb !important; }
            .btn-primary { background-color: #2563eb; border: none; border-radius: 0.75rem; padding: 0.6rem 1.5rem; transition: all 0.3s ease; }
            .btn-primary:hover { background-color: #1d4ed8; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }

            /* Pastikan Modal Backdrop berada di bawah Modal Content */
.modal-backdrop {
    z-index: 1040 !important;
}
.modal {
    z-index: 1050 !important;
}

/* Memperbaiki masalah klik yang terhalang */
body.modal-open {
    overflow: hidden;
    padding-right: 0 !important;
}
            
            /* Card Styling */
            .rounded-4 { border-radius: 1.5rem !important; }
            .card { border: 1px solid rgba(0,0,0,0.03); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
            .card-materi:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.06) !important; }
            
            /* Layout & Main Wrapper */
            main { flex: 1 0 auto; }
            
            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: #f1f1f1; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="flex flex-col min-h-screen">
            @include('layouts.navigation')

            @if(session('success'))
                <div class="container mt-4" data-aos="fade-left">
                    <div class="alert alert-success border-0 shadow-sm rounded-4 p-3 d-flex align-items-center">
                        <span class="me-3">✅</span>
                        <div class="fw-bold">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="container mt-4" data-aos="fade-left">
                    <div class="alert alert-danger border-0 shadow-sm rounded-4 p-3 d-flex align-items-center">
                        <span class="me-3">🚫</span>
                        <div class="fw-bold">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            <main>
                {{ $slot }}
            </main>

            <footer class="py-4 mt-5" style="background-color: #2563eb;">
                <div class="container text-center text-md-start">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h5 class="fw-bold mb-1">SIPI - SMA Negeri 1 Sindangkasih</h5>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="text-light small mb-0 fw-medium">
                                © 2026 Muhammad Rikza Wangsa Wijaya. Universitas Galuh.
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            // Inisialisasi Animasi Scroll
            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-out-cubic'
            });
        </script>
    </body>
</html>