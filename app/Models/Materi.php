<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Materi extends Model
{
    protected $fillable = [
        'modul_id',
        'judul_materi',
        'tipe',
        'file_path',
        'url_video',
        'urutan',
    ];

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    /**
     * URL publik file yang diupload (PDF atau video), kalau ada.
     */
    public function fileUrl(): ?string
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : null;
    }

    /**
     * URL video untuk ditonton: prioritaskan file upload, fallback ke link eksternal.
     */
    public function videoUrl(): ?string
    {
        return $this->fileUrl() ?? $this->url_video;
    }

    /**
     * Apakah video ini berasal dari link eksternal (YouTube/Vimeo) dan bukan file upload.
     */
    public function isEmbedVideo(): bool
    {
        return $this->tipe === 'video' && !$this->file_path && !empty($this->url_video);
    }

    /**
     * Ubah link YouTube/Vimeo biasa menjadi URL embed agar bisa ditampilkan di iframe.
     */
    public function embedUrl(): ?string
    {
        $url = $this->url_video;
        if (!$url) {
            return null;
        }

        // YouTube: watch?v=, youtu.be/, atau shorts/
        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|shorts\/|embed\/))([a-zA-Z0-9_-]{6,})/', $url, $match)) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }

        // Vimeo: vimeo.com/12345678
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $match)) {
            return 'https://player.vimeo.com/video/' . $match[1];
        }

        return $url;
    }
}
