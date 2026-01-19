<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Scoreboard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Guru
        $guru = User::create([
            'name' => 'Admin',
            'email' => 'admin@sipi.com',
            'password' => Hash::make('admin123'),
            'level_akses' => 'admin',
            'kelas' => '',
        ]);

        // 2. Buat Akun Siswa (Untuk testing)
        // $siswa = User::create([
        //     'name' => 'Muhammad Rikza',
        //     'email' => 'siswa@sipi.com',
        //     'password' => Hash::make('siswa123'),
        //     'level_akses' => 'siswa',
        //     'kelas' => 'XII RPL 1',
        // ]);

        // 3. Buat Scoreboard untuk Siswa
        // Scoreboard::create([
        //     'user_id' => $siswa->id,
        //     'poin_akumulasi' => 850
        // ]);

        // 4. (Opsional) Jika Anda punya seeder lain seperti KuisSeeder atau MateriSeeder
        // $this->call([
        //     MateriSeeder::class,
        // ]);
    }
}
