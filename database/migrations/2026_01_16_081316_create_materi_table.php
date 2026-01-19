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
        Schema::create('materi', function (Blueprint $table) {
            $table->id(); // id_materi: int [cite: 1851]
            $table->string('judul_materi'); // [cite: 1852]
            $table->text('deskripsi'); // [cite: 1853]
            $table->string('kategori'); // [cite: 1854]
            $table->integer('peringkat_global')->default(0); // [cite: 1855]
            $table->string('thumbnail')->nullable(); // [cite: 1856]
            $table->longText('galeri_gambar')->nullable(); // [cite: 1860]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
