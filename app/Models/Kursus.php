<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursus extends Model
{
    use HasFactory;

    protected $table = 'kursuses';
    protected $fillable = [
        'kategori_id', 
        'judul', 
        'slug', 
        'deskripsi', 
        'thumbnail', 
        'status_kelas', 
        'metode_belajar', 
        'tingkat_kesiapan', 
        'sertifikat'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peserta()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'kursus_id', 'user_id')
                    ->withPivot('status', 'created_at')
                    ->withTimestamps();
    }

    public function moduls()
    {
        return $this->hasMany(Modul::class, 'kursus_id')->orderBy('urutan');
    }
}