<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'judul_materi',
        'deskripsi',
        'kategori',
        'peringkat_global',
        'thumbnail',
        'galeri_gambar'
    ];

    // Relasi ke Modul (1 Materi memiliki banyak Modul)
    public function moduls(): HasMany
    {
        return $this->hasMany(Modul::class, 'materi_id');
    }

    // Relasi ke Kuis (1 Materi memiliki banyak soal Kuis)
    public function kuis(): HasMany
    {
        return $this->hasMany(Kuis::class, 'materi_id');
    }
}
