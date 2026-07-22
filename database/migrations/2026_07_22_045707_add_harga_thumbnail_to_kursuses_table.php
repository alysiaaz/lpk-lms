<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kursuses', function (Blueprint $table) {
            if (!Schema::hasColumn('kursuses', 'harga')) {
                $table->integer('harga')->default(0)->after('deskripsi');
            }
            if (!Schema::hasColumn('kursuses', 'thumbnail')) {
                $table->string('thumbnail')->nullable()->after('harga');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kursuses', function (Blueprint $table) {
            if (Schema::hasColumn('kursuses', 'harga')) {
                $table->dropColumn('harga');
            }
            if (Schema::hasColumn('kursuses', 'thumbnail')) {
                $table->dropColumn('thumbnail');
            }
        });
    }
};