<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KuisController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'materi_id'     => 'required|exists:materi,id',
            'pertanyaan'    => 'required|string',
            'image'         => 'nullable|image|max:2048',
            'jawaban_a'     => 'required|string',
            'jawaban_b'     => 'required|string',
            'jawaban_c'     => 'required|string',
            'jawaban_d'     => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('kuis', 'public');
            }

            $kuis = Kuis::create([
                'materi_id'     => $request->materi_id,
                'pertanyaan'    => $request->pertanyaan,
                'image'         => $imagePath,
                'jawaban_a'     => $request->jawaban_a,
                'jawaban_b'     => $request->jawaban_b,
                'jawaban_c'     => $request->jawaban_c,
                'jawaban_d'     => $request->jawaban_d,
                'jawaban_benar' => $request->jawaban_benar,
            ]);

            return response()->json(['success' => true, 'data' => $kuis], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $kuis = Kuis::find($id);
        if (!$kuis) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        $validator = Validator::make($request->all(), [
            'pertanyaan'    => 'required|string',
            'image'         => 'nullable|image|max:2048',
            'jawaban_a'     => 'required|string',
            'jawaban_b'     => 'required|string',
            'jawaban_c'     => 'required|string',
            'jawaban_d'     => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $imagePath = $kuis->image;

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($kuis->image) {
                    Storage::disk('public')->delete($kuis->image);
                }
                $imagePath = $request->file('image')->store('kuis', 'public');
            }

            $kuis->update([
                'pertanyaan'    => $request->pertanyaan,
                'image'         => $imagePath,
                'jawaban_a'     => $request->jawaban_a,
                'jawaban_b'     => $request->jawaban_b,
                'jawaban_c'     => $request->jawaban_c,
                'jawaban_d'     => $request->jawaban_d,
                'jawaban_benar' => $request->jawaban_benar,
            ]);

            return response()->json(['success' => true, 'data' => $kuis]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $kuis = Kuis::find($id);
        if (!$kuis) return response()->json(['message' => 'Data tidak ditemukan'], 404);

        try {
            // Hapus file gambar jika ada di storage
            if ($kuis->image) {
                Storage::disk('public')->delete($kuis->image);
            }

            $kuis->delete();
            return response()->json(['success' => true, 'message' => 'Kuis berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
