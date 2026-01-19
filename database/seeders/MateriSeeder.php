<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Materi::create([
        'judul_materi' => 'Pengenalan Algoritma',
        'deskripsi' => 'Belajar dasar-dasar logika pemrograman dan flowchart.',
        'kategori' => 'Informatika',
        'peringkat_global' => 5,
    ]);
    }
}
