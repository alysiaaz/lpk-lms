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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kursus_id')->constrained('kursuses')->cascadeOnDelete();
            $table->string('judul');
            $table->enum('tipe', ['pre-test', 'post-test']);
            $table->text('deskripsi')->nullable();
            $table->integer('waktu_menit')->default(30); // Durasi ujian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
