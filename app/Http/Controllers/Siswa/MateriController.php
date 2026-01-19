<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\JawabanSiswa; // Tambahkan import Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    /**
     * Menampilkan semua materi ajar dengan fitur pencarian AJAX.
     */
    public function index(Request $request)
    {
        $query = Materi::withCount(['moduls', 'kuis']);

        // Logika Pencarian yang lebih spesifik
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_materi', 'like', '%' . $search . '%')
                  ->orWhere('kategori', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $materis = $query->latest()->get();

        // Cek jika request adalah AJAX untuk pencarian real-time
        if ($request->ajax()) {
            return view('siswa.materi._list', compact('materis'))->render();
        }

        return view('siswa.materi.index', compact('materis'));
    }

    /**
     * Menampilkan detail materi, daftar modul, dan status kelulusan kuis.
     */
    public function show($id)
    {
        // Eager load moduls dan kuis untuk efisiensi
        $materi = Materi::with(['moduls', 'kuis'])->findOrFail($id);

        // Ambil data hasil kuis siswa untuk materi ini
        // Menggunakan JawabanSiswa yang diimport di atas
        $hasilKuis = JawabanSiswa::where('user_id', Auth::id())
            ->whereHas('kuis', function($query) use ($id) {
                $query->where('materi_id', $id);
            })
            ->first();

        return view('siswa.materi.show', compact('materi', 'hasilKuis'));
    }

    public function viewModul($id)
{
    $modul = \App\Models\Modul::with('materi')->findOrFail($id);
    return view('siswa.materi.view_modul', compact('modul'));
}
}