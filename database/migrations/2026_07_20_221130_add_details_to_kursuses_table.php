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
        Schema::table('kursuses', function (Blueprint $table) {
        $table->string('status_kelas')->default('Pendaftaran Buka');
        $table->string('metode_belajar')->nullable();
        $table->string('tingkat_kesiapan')->nullable();
        $table->string('sertifikat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kursuses', function (Blueprint $table) {
            //
        });
    }
};
