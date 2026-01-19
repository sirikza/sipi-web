<x-app-layout>
    <div class="container py-5 flex-grow-1">
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="fw-extrabold text-dark mb-2" style="font-size: 2.5rem; letter-spacing: -0.02em;">Kuis:
                {{ $materi->judul_materi }}</h1>
            <p class="text-secondary fw-medium">Pilihlah jawaban yang paling tepat untuk setiap pertanyaan di bawah ini.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('siswa.kuis.submit', $materi->id) }}" method="POST" id="quizForm">
                    @csrf

                    @foreach ($questions as $index => $q)
                        <div class="card border-0 shadow-sm rounded-4 mb-4 p-4 p-md-5" data-aos="fade-up"
                            data-aos-delay="{{ $index * 100 }}">
                            <div class="d-flex align-items-start mb-4">
                                <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center me-3 shadow-sm"
                                    style="min-width: 45px; height: 45px; font-weight: 800;">
                                    {{ $index + 1 }}
                                </div>

                                <div class="flex-grow-1">
                                    <h4 class="fw-bold text-dark mb-3" style="line-height: 1.5; font-size: 1.3rem;">
                                        {{ $q->pertanyaan }}
                                    </h4>

                                    @if ($q->image)
                                        <div class="mb-4">
                                            <div
                                                class="d-inline-block p-1 border rounded-4 bg-white shadow-sm overflow-hidden">
                                                <img src="{{ asset('storage/' . $q->image) }}"
                                                    alt="Gambar untuk soal nomor {{ $index + 1 }}"
                                                    class="img-fluid rounded-3"
                                                    style="max-height: 350px; width: auto; object-fit: contain;">
                                            </div>
                                            <div class="mt-2 text-muted small italic">
                                                <i class="fas fa-search-plus me-1"></i> Perhatikan gambar di atas untuk
                                                menjawab soal.
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach (['a', 'b', 'c', 'd'] as $option)
                                    <label
                                        class="answer-card d-block position-relative p-3 rounded-4 border mb-3 transition-all cursor-pointer">
                                        <input type="radio" name="question_{{ $q->id }}"
                                            value="{{ $option }}" class="d-none" required>
                                        <div class="d-flex align-items-center">
                                            <div class="option-circle rounded-circle border d-flex align-items-center justify-content-center me-3 fw-bold text-uppercase"
                                                style="width: 35px; height: 35px;">
                                                {{ $option }}
                                            </div>
                                            <span
                                                class="fw-medium text-secondary">{{ $q->{'jawaban_' . $option} }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center mt-5 mb-5" data-aos="zoom-in">
                        <button type="submit"
                            class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-extrabold shadow-lg border-0 transition-transform">
                            Kirim Jawaban & Lihat Hasil 🚀
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .fw-extrabold {
            font-weight: 800;
        }

        .rounded-4 {
            border-radius: 1.5rem !important;
        }

        .answer-card {
            border-color: #f1f5f9;
            background-color: #f8fafc;
            cursor: pointer;
        }

        .answer-card:hover {
            border-color: #2563eb;
            background-color: #eff6ff;
            transform: translateX(5px);
        }

        /* Styling saat input di-check */
        .answer-card input:checked+div .option-circle {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .answer-card input:checked~div span {
            color: #2563eb !important;
            font-weight: 700;
        }

        .answer-card input:checked {
            display: block;
            /* Hanya untuk trigger visual */
        }

        .answer-card:has(input:checked) {
            border-color: #2563eb !important;
            background-color: #eff6ff !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);
        }

        .btn-primary:hover {
            transform: scale(1.05);
            background-color: #1d4ed8;
        }
    </style>
</x-app-layout>
