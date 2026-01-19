<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimpor

class ModulController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'materi_id'   => 'required|exists:materi,id',
            'judul_modul' => 'required|string|max:255',
            'tipe_konten' => 'required|in:Video,PDF',
            'konten'      => 'required', // Bisa berupa file atau string url
        ]);

        try {
            $isiKonten = $request->konten;

            // Jika tipenya PDF, proses upload file
            if ($request->tipe_konten === 'PDF' && $request->hasFile('konten')) {
                $isiKonten = $request->file('konten')->store('moduls', 'public');
            }

            $modul = Modul::create([
                'materi_id'   => $request->materi_id,
                'judul_modul' => $request->judul_modul,
                'tipe_konten' => $request->tipe_konten,
                'konten'      => $isiKonten,
            ]);

            return response()->json([
                'success' => true,
                'data'    => $modul
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $modul = Modul::find($id);
        if (!$modul) return response()->json(['message' => 'Modul tidak ditemukan'], 404);

        $request->validate([
            'judul_modul' => 'required|string|max:255',
            'tipe_konten' => 'required|in:Video,PDF',
            'konten'      => 'required',
        ]);

        try {
            $isiKonten = $request->konten;

            // Jika ada upload file PDF baru
            if ($request->tipe_konten === 'PDF' && $request->hasFile('konten')) {
                // Hapus file lama jika sebelumnya memang PDF
                if ($modul->tipe_konten === 'PDF') {
                    Storage::disk('public')->delete($modul->konten);
                }
                $isiKonten = $request->file('konten')->store('moduls', 'public');
            }
            // Jika berubah dari PDF ke Video, hapus file lamanya
            elseif ($request->tipe_konten === 'Video' && $modul->tipe_konten === 'PDF') {
                Storage::disk('public')->delete($modul->konten);
            }

            $modul->update([
                'judul_modul' => $request->judul_modul,
                'tipe_konten' => $request->tipe_konten,
                'konten'      => $isiKonten,
            ]);

            return response()->json(['success' => true, 'data' => $modul]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $modul = Modul::find($id);
        if (!$modul) return response()->json(['message' => 'Data tidak ada'], 404);

        // Hapus file fisik jika tipenya PDF
        if ($modul->tipe_konten === 'PDF') {
            Storage::disk('public')->delete($modul->konten);
        }

        $modul->delete();
        return response()->json(['message' => 'Modul dihapus']);
    }
}
