<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Ubah username menjadi name
            $table->renameColumn('username', 'name');

            // 2. Hapus kolom role dan tanggal_daftar
            $table->dropColumn(['role', 'tanggal_daftar']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'username');
            $table->integer('role')->default(3);
            $table->timestamp('tanggal_daftar')->useCurrent();
        });
    }
};