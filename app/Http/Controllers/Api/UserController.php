<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Mengambil semua user kecuali admin yang sedang login
    public function index(Request $request)
    {
        $users = User::where('id', '!=', $request->user()->id)->get();
        return response()->json($users);
    }

    // Tambah User Baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level_akses' => 'required|in:admin,guru,siswa',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level_akses' => $request->level_akses,
        ]);

        return response()->json(['success' => true, 'data' => $user], 201);
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'level_akses' => 'required|in:admin,guru,siswa',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level_akses = $request->level_akses;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return response()->json(['success' => true, 'data' => $user]);
    }

    // Hapus User
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
}
