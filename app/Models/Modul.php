<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modul extends Model
{
    protected $table = 'modul';

    protected $fillable = [
        'materi_id',
        'judul_modul',
        'tipe_konten', // Enum: Video, PDF
        'konten'
    ];

    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class, 'materi_id');
    }
}
