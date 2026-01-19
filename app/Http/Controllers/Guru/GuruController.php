<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Materi;
use Illuminate\Support\Facades\Schema;

class GuruController extends Controller
{
    public function index()
    {
        // Mengambil statistik dasar
        $data = [
            'total_siswa'    => User::where('level_akses', 'siswa')->count(),
            'total_materi'   => Materi::count(),
            'total_kuis'     => Schema::hasTable('kuis') ? \DB::table('kuis')->count() : 0,
            'materi_terbaru' => Materi::latest()->take(5)->get(),
        ];

        return view('guru.dashboard', $data);
    }
}
