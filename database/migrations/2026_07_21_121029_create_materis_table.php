<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_id')->constrained('moduls')->onDelete('cascade');
            $table->string('judul_materi');
            $table->enum('tipe', ['pdf', 'video'])->default('pdf');
            $table->string('file_path')->nullable(); // path file PDF/video yang diupload
            $table->string('url_video')->nullable(); // link eksternal (YouTube/Vimeo) utk tipe video
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};