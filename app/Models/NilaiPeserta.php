<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPeserta extends Model
{
    use HasFactory;

    protected $table = 'nilai_pesertas';

    protected $fillable = [
        'user_id',
        'ujian_id',
        'skor',
    ];

    // Relasi ke User (Peserta)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Ujian (Pre-test / Post-test)
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}