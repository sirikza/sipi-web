<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Kuis;

class KuisSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Materi Terlebih Dahulu
        $materi = Materi::create([
            'judul_materi' => 'Dasar Pemrograman Laravel',
            'deskripsi' => 'Pelajari arsitektur MVC dan cara kerja framework Laravel 11.',
            'kategori' => 'Informatika',
            'peringkat_global' => 5,
            'thumbnail' => null, // Bisa diisi path gambar nanti
        ]);

        // 2. Buat Beberapa Soal Kuis untuk Materi di atas
        $soal = [
            [
                'materi_id' => $materi->id,
                'pertanyaan' => 'Apa kepanjangan dari MVC dalam arsitektur Laravel?',
                'jawaban_a' => 'Model View Center',
                'jawaban_b' => 'Model View Controller',
                'jawaban_c' => 'Main View Controller',
                'jawaban_d' => 'Model Variable Control',
                'jawaban_benar' => 'b',
            ],
            [
                'materi_id' => $materi->id,
                'pertanyaan' => 'Command artisan manakah yang digunakan untuk menjalankan server lokal?',
                'jawaban_a' => 'php artisan start',
                'jawaban_b' => 'php artisan run',
                'jawaban_c' => 'php artisan serve',
                'jawaban_d' => 'php artisan dev',
                'jawaban_benar' => 'c',
            ],
            [
                'materi_id' => $materi->id,
                'pertanyaan' => 'Di folder manakah file route web biasanya berada?',
                'jawaban_a' => 'app/Http',
                'jawaban_b' => 'resources/views',
                'jawaban_c' => 'config/routes',
                'jawaban_d' => 'routes/web.php',
                'jawaban_benar' => 'd',
            ]
        ];

        foreach ($soal as $s) {
            Kuis::create($s);
        }
    }
}