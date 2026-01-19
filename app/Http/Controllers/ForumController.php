<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function store(Request $request, $materi_id)
    {
        $request->validate(['pesan' => 'required|string']);

        Discussion::create([
            'user_id' => Auth::id(),
            'materi_id' => $materi_id,
            'pesan' => $request->pesan,
            'parent_id' => $request->parent_id ?? null,
        ]);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim ke forum.');
    }
}