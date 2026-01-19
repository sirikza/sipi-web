<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modul;
use App\Models\Materi;

class ModulSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil materi pertama yang ada di database
        $materi = Materi::first();

        if ($materi) {
            // Modul Video (Simulasi link eksternal)
            Modul::create([
                'materi_id' => $materi->id,
                'judul_modul' => 'Video Tutorial: Arsitektur MVC',
                'tipe_konten' => 'Video',
                'konten' => 'https://youtu.be/dLar3ee6JeA?si=Wox4945-E1kx999w',
            ]);

            // Modul PDF (Pastikan file ada di storage/app/public/modul/...)
            Modul::create([
                'materi_id' => $materi->id,
                'judul_modul' => 'E-Book: Panduan Routing Laravel',
                'tipe_konten' => 'PDF',
                'konten' => 'modul/panduan-routing.pdf',
            ]);
        }
    }
}