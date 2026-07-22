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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order')->unique();
            $table->foreignId('peserta_id')->constrained('users');
            $table->foreignId('kursus_id')->constrained('kursuses');
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers');
            $table->integer('subtotal');
            $table->integer('diskon')->default(0);
            $table->integer('total');
            $table->enum('status', ['pending', 'lunas', 'gagal', 'kadaluarsa'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
