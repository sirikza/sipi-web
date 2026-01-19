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
        Schema::create('kuis', function (Blueprint $table) {
            $table->id(); // id_kuis: int [cite: 1888]
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade'); // [cite: 1889]
            $table->longText('pertanyaan'); // [cite: 1890]
            $table->string('jawaban_a'); // [cite: 1891]
            $table->string('jawaban_b'); // [cite: 1892]
            $table->string('jawaban_c'); // [cite: 1893]
            $table->string('jawaban_d'); // [cite: 1894]
            $table->enum('jawaban_benar', ['a', 'b', 'c', 'd']); // [cite: 1895]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
