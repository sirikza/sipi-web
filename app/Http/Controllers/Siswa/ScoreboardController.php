<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Scoreboard;

class ScoreboardController extends Controller
{
    public function index()
    {
        // Ambil data peringkat tertinggi
        $rankings = Scoreboard::with('user')
            ->orderBy('poin_akumulasi', 'desc')
            ->get();

        return view('siswa.scoreboard.index', compact('rankings'));
    }
}