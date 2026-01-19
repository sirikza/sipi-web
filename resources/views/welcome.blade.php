<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPI - SMA Negeri 1 Sindangkasih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; overflow-x: hidden; }
        .navbar { background: white; border-bottom: 1px solid #eee; transition: all 0.3s ease; }
        .nav-link { font-weight: 500; color: #333 !important; }
        
        /* Hero Animation */
        .hero { 
            background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)), 
                        url('/images/bg2.jpg') no-repeat center center;
            background-size: cover;
            padding: 150px 0;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .section-title { font-weight: 700; margin-bottom: 40px; position: relative; }
        
        /* Interactive Feature Cards */
        .feature-card { 
            border: 1px solid #eee; 
            border-radius: 15px; 
            padding: 30px; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
            height: 100%; 
        }
        .feature-card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.1);
            border-color: #2563eb;
        }
        
        .feature-icon { 
            font-size: 2.5rem; 
            color: #2563eb; 
            margin-bottom: 1rem; 
            transition: transform 0.3s ease;
        }
        .feature-card:hover .feature-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .footer { background: #1a1a1a; color: white; padding: 20px 0; }

        /* Button Hover Effects */
        .btn-primary { transition: all 0.3s ease; }
        .btn-primary:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(37, 99, 235, 0.4); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">SIPI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link mx-2" href="#about">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="#fiture">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link mx-2" href="#contact">Kontak</a></li>
                    
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 me-2">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="container text-center" data-aos="fade-up">
            <h1 class="display-3 fw-bold mb-4">Belajar Lebih Interaktif <br><span class="text-primary">Dimana Saja</span></h1>
            <p class="lead text-secondary mb-5">Platform Sistem Informasi Pembelajaran Interaktif (SIPI) <br> Khusus untuk Siswa & Guru SMA Negeri 1 Sindangkasih.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#fiture" class="btn btn-outline-secondary btn-lg rounded-pill">Pelajari Fitur</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill">Mulai Belajar</a>
            </div>
        </div>
    </section>

    <section id="about" class="py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="images/unigal.png" class="img-fluid rounded shadow-lg" alt="Tentang SIPI">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <h2 class="section-title">Tentang SIPI</h2>
                    <p>Berdasarkan analisis di SMA Negeri 1 Sindangkasih, SIPI hadir sebagai solusi untuk mempermudah komunikasi materi antara guru dan siswa secara interaktif.</p>
                    <p>Dikembangkan dengan metode <b>Scrum</b> untuk memastikan sistem sesuai dengan kebutuhan pengguna di lapangan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="fiture" class="py-5 bg-primary bg-opacity-10">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="zoom-in">
                <h2 class="section-title">Fitur Unggulan</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card bg-white">
                        <div class="feature-icon">📚</div>
                        <h4 class="fw-bold mb-3">Manajemen Materi</h4>
                        <p class="text-muted">Guru dapat mengunggah modul dalam format PDF dan Video yang terorganisir dengan baik.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card bg-white">
                        <div class="feature-icon">📝</div>
                        <h4 class="fw-bold mb-3">Kuis Interaktif</h4>
                        <p class="text-muted">Evaluasi belajar siswa dengan sistem kuis otomatis yang memberikan nilai langsung secara real-time.</p>
                    </div>
                </div>
                <div class="col-md-4 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card bg-white">
                        <div class="feature-icon">🏆</div>
                        <h4 class="fw-bold mb-3">Global Scoreboard</h4>
                        <p class="text-muted">Meningkatkan motivasi belajar siswa melalui papan skor peringkat global berdasarkan hasil kuis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <h2 class="section-title">Hubungi Kami</h2>
                    <p>Jangan ragu untuk menghubungi kami melalui detail di bawah ini. Kami siap membantu Anda.</p>
                    <p><strong>Alamat:</strong> Jl. Raya Sindangkasih No. XX, Ciamis</p>
                    <p><strong>Email:</strong> info@sman1sindangkasih.sch.id</p>
                    <div class="mt-4 rounded-4 overflow-hidden shadow-sm border" style="height: 300px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15843.080447348982!2d108.2612!3d-7.3235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTknMjQuNiJTIDEwOMKwMTUnNDAuMyJF!5e0!3m2!1sid!2sid!4v1625000000000!5m2!1sid!2sid" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <form class="card border-0 shadow-lg rounded-4 p-4">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control rounded-pill" placeholder="Masukkan nama...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control rounded-pill" placeholder="nama@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea class="form-control rounded-4" rows="3" placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-1">Sistem Informasi Pembelajaran Interaktif (SIPI)</p>
            <p class="small text-secondary mt-1">© 2025 Muhammad Rikza Wangsa Wijaya - Universitas Galuh</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out'
        });
    </script>
    <script>
    // Mengubah bayangan navbar saat scroll
    window.addEventListener('scroll', function() {
        const nav = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            nav.classList.add('shadow');
        } else {
            nav.classList.remove('shadow');
        }
    });
    </script>
</body>
</html>