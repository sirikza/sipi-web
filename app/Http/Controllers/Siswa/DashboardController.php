<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\Scoreboard;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Ambil materi paling baru untuk di-highlight
        $latestMateri = Materi::withCount(['moduls', 'kuis'])->latest()->first();
        
        // 2. Ambil total skor user
        $score = Scoreboard::where('user_id', $userId)->first();

        // 3. Hitung Peringkat User (berdasarkan akumulasi poin tertinggi)
        // Logika: Hitung berapa orang yang poinnya lebih tinggi dari user ini, lalu + 1
        $rank = 0;
        if ($score) {
            $rank = Scoreboard::where('poin_akumulasi', '>', $score->poin_akumulasi)->count() + 1;
        }

        // 4. Ambil Diskusi Terbaru di Forum (untuk memantau interaksi)
        $recentDiscussions = Discussion::with(['user', 'materi'])
            ->whereHas('materi') // Pastikan materinya masih ada
            ->latest()
            ->take(3)
            ->get();

        return view('siswa.dashboard', compact('latestMateri', 'score', 'rank', 'recentDiscussions'));
    }
}