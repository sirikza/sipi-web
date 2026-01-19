<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discussion;
use Carbon\Carbon;

class AutoDeleteOldDiscussions extends Command
{
    // Nama perintah yang akan dipanggil di terminal
    protected $signature = 'discussion:auto-delete';

    // Deskripsi perintah
    protected $description = 'Menghapus pesan forum yang sudah lebih dari 3 hari';

    public function handle()
    {
        // Cari diskusi yang created_at nya lebih lama dari 3 hari yang lalu
        $deletedCount = Discussion::where('created_at', '<', Carbon::now()->subDays(3))
                                    ->delete();

        $this->info("Berhasil menghapus {$deletedCount} pesan forum yang sudah kadaluarsa.");
    }
}