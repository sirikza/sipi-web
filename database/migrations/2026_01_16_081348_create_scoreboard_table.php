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
        Schema::create('scoreboard', function (Blueprint $table) {
            $table->id(); // id_score: int [cite: 1839]
            $table->foreignId('user_id')->unique()->constrained('users'); // [cite: 1840]
            $table->float('poin_akumulasi')->default(0); // [cite: 1841]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scoreboard');
    }
};
