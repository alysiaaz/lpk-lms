<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ujian;
use Illuminate\Support\Facades\Storage;

class Kursus extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($kursus) {
            if ($kursus->thumbnail && Storage::exists('public/' . $kursus->thumbnail)) {
                Storage::delete('public/' . $kursus->thumbnail);
            }
        });
    }
    
    protected $table = 'kursuses';
    protected $fillable = [
        'kategori_id', 
        'judul', 
        'slug', 
        'deskripsi', 
        'harga',
        'thumbnail', 
        'status_kelas', 
        'metode_belajar', 
        'tingkat_kesiapan', 
        'sertifikat',
        'is_unggulan'
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

    public function ujians()
    {
        return $this->hasMany(Ujian::class);
    }
}