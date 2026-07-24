<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kursus()
    {
        return $this->belongsTo(Kursus::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function nilais()
    {
        return $this->hasMany(NilaiPeserta::class);
    }
}