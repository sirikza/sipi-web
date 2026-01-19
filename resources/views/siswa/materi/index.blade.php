<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <div class="mb-5" data-aos="fade-down">
            <h1 class="fw-extrabold text-dark mb-2" style="font-size: 2.8rem; letter-spacing: -0.02em;">Materi Ajar</h1>
            <p class="text-secondary" style="font-size: 1.2rem; font-weight: 500;">Eksplorasi berbagai materi menarik untuk meningkatkan wawasanmu.</p>
        </div>

        <div class="row mb-4" data-aos="fade-up">
            <div class="col-md-6">
                <div class="input-group mb-3 shadow-sm rounded-4 overflow-hidden bg-white border">
                    <span class="input-group-text bg-white border-0 ps-4">🔍</span>
                    <input type="text" id="search-input" class="form-control border-0 py-3 ps-2" 
                           placeholder="Ketik judul atau kategori materi..." style="outline: none; box-shadow: none;">
                </div>
            </div>
            </div>
            <div class="row g-4 mb-5" id="materi-container">
            @include('siswa.materi._list')
        </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('siswa.materi.index') }}",
                    type: "GET",
                    data: { 'search': query },
                    success: function(data) {
                        // Mengganti isi container materi dengan hasil pencarian
                        $('#materi-container').html(data);
                    }
                });
            });
        });
    </script>

    <style>
        .fw-extrabold { font-weight: 800; }
        .rounded-4 { border-radius: 1.5rem !important; }
        .transition-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); border: 1px solid rgba(0,0,0,0.03) !important; }
        .transition-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.06) !important; }
        .input-group:focus-within { ring: 2px solid #2563eb; }
    </style>
</x-app-layout>