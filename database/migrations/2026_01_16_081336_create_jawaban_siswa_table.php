<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel Jawaban Siswa
        Schema::create('jawaban_siswa', function (Blueprint $table) {
            $table->id(); // id_jawaban: int [cite: 1903]
            $table->foreignId('user_id')->constrained('users'); // [cite: 1904]
            $table->foreignId('kuis_id')->constrained('kuis'); // [cite: 1905]
            $table->float('total_skor'); // [cite: 1906]
            $table->dateTime('waktu_selesai'); // [cite: 1907]
            $table->enum('status', ['Lulus', 'Remedial']); // [cite: 1908]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_siswa');
    }
};
