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
        Schema::create('modul', function (Blueprint $table) {
            $table->id(); // id_modul: int [cite: 1877]
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade'); // Hubungan 1..n [cite: 1879]
            $table->string('judul_modul'); // [cite: 1880]
            $table->enum('tipe_konten', ['Video', 'PDF']); // [cite: 1881]
            $table->string('konten'); // URL file atau teks [cite: 1882]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul');
    }
};
