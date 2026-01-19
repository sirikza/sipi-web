<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::with(['moduls', 'kuis'])->get();
        return response()->json($materi);
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'judul_materi' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'kategori'     => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            // Inisialisasi variabel path dengan null
            $thumbnailPath = null;

            // 2. Logika Simpan File Gambar
            if ($request->hasFile('thumbnail')) {
                // Simpan file dan dapatkan path-nya (e.g., thumbnails/abc.jpg)
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // 3. Simpan ke Database
            $materi = Materi::create([
                'judul_materi' => $request->judul_materi,
                'deskripsi'    => $request->deskripsi,
                'kategori'     => $request->kategori,
                'thumbnail'    => $thumbnailPath, // Sekarang variabel ini sudah terisi path
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Materi berhasil ditambahkan',
                'data'    => $materi
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $materi = Materi::with(['moduls', 'kuis'])->find($id);
        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }
        return response()->json($materi);
    }

    /**
     * Update materi.
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        // 1. Validasi Input (Hampir sama dengan store)
        $validator = Validator::make($request->all(), [
            'judul_materi' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'kategori'     => 'required|string',
            'thumbnail'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            // Ambil data yang dikirim (kecuali thumbnail)
            $data = $request->only(['judul_materi', 'deskripsi', 'kategori']);

            // 2. Logika Update Thumbnail
            if ($request->hasFile('thumbnail')) {
                // Hapus thumbnail lama jika ada
                if ($materi->thumbnail) {
                    Storage::disk('public')->delete($materi->thumbnail);
                }

                // Simpan thumbnail baru
                $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // 3. Update data di database
            $materi->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Materi berhasil diperbarui',
                'data'    => $materi
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete materi.
     */
    public function destroy($id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }

        try {
            // Hapus file gambar dari storage sebelum datanya dihapus
            if ($materi->thumbnail) {
                Storage::disk('public')->delete($materi->thumbnail);
            }

            // Hapus data dari database
            $materi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Materi dan filenya berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
