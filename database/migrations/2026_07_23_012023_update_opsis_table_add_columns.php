<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opsis', function (Blueprint $table) {
            // Menambahkan kolom foreign key ke tabel soals
            $table->foreignId('soal_id')->after('id')->constrained('soals')->onDelete('cascade');
            // Menambahkan teks isi pilihan ganda
            $table->text('teks_pilihan')->after('soal_id');
            // Menambahkan penanda apakah opsi ini jawaban benar (1 = benar, 0 = salah)
            $table->boolean('is_benar')->default(false)->after('teks_pilihan');
        });
    }

    public function down(): void
    {
        Schema::table('opsis', function (Blueprint $table) {
            $table->dropForeign(['soal_id']);
            $table->dropColumn(['soal_id', 'teks_pilihan', 'is_benar']);
        });
    }
};