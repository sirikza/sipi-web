<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\Materi;
use App\Models\JawabanSiswa;
use App\Models\Scoreboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    /**
     * Menampilkan daftar soal kuis berdasarkan materi.
     */
    public function show($materi_id)
    {
        // 1. Proteksi: Cek apakah siswa sudah pernah mengerjakan kuis di materi ini
        $sudahMengerjakan = JawabanSiswa::where('user_id', Auth::id())
            ->whereHas('kuis', function ($query) use ($materi_id) {
                $query->where('materi_id', $materi_id);
            })->exists();

        if ($sudahMengerjakan) {
            // Perbaikan route name menjadi siswa.materi.show
            return redirect()->route('siswa.materi.show', $materi_id)
                ->with('error', 'Anda sudah mengerjakan kuis ini sebelumnya.');
        }

        $materi = Materi::findOrFail($materi_id);

        // Mengambil soal, kolom 'image' otomatis terbawa jika sudah ada di DB
        $questions = Kuis::where('materi_id', $materi_id)->get();

        if ($questions->isEmpty()) {
            return redirect()->back()->with('error', 'Soal kuis belum tersedia untuk materi ini.');
        }

        return view('siswa.kuis.show', compact('materi', 'questions'));
    }

    /**
     * Menghitung jawaban dan update skor.
     */
    public function submit(Request $request, $materi_id)
    {
        $questions = Kuis::where('materi_id', $materi_id)->get();

        if ($questions->isEmpty()) {
            return redirect()->route('siswa.dashboard');
        }

        $totalQuestions = $questions->count();
        $correctAnswers = 0;

        foreach ($questions as $q) {
            $userAnswer = $request->input('question_' . $q->id);
            if ($userAnswer == $q->jawaban_benar) {
                $correctAnswers++;
            }
        }

        $skor = ($correctAnswers / $totalQuestions) * 100;
        $status = $skor >= 75 ? 'Lulus' : 'Remedial';

        DB::beginTransaction();
        try {
            // 1. Simpan log hasil pengerjaan
            JawabanSiswa::create([
                'user_id' => Auth::id(),
                'kuis_id' => $questions->first()->id,
                'total_skor' => $skor,
                'waktu_selesai' => now(),
                'status' => $status
            ]);

            // 2. Update Scoreboard (Poin Akumulasi)
            $score = Scoreboard::firstOrCreate(
                ['user_id' => Auth::id()],
                ['poin_akumulasi' => 0]
            );
            $score->increment('poin_akumulasi', $skor);

            DB::commit();

            return redirect()->route('siswa.dashboard')->with('success', "Kuis Selesai! Skor Anda: " . number_format($skor, 0) . " ($status).");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('siswa.dashboard')->with('error', 'Gagal menyimpan hasil kuis.');
        }
    }
}
