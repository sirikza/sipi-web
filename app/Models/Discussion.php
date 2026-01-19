<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    use HasFactory;

    // Karena nama tabel kita tunggal sesuai diskusi sebelumnya
    protected $table = 'discussions';

    protected $fillable = [
        'user_id',
        'materi_id',
        'pesan',
        'parent_id', // ID pesan yang dibalas (jika ada)
    ];

    /**
     * Relasi ke User: Satu pesan dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Materi: Satu pesan tertuju pada satu materi.
     */
    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Relasi ke Parent: Mengambil pesan induk (pesan yang dibalas).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Discussion::class, 'parent_id');
    }

    /**
     * Relasi ke Replies: Satu pesan bisa memiliki banyak balasan.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Discussion::class, 'parent_id')->orderBy('created_at', 'asc');
    }
}