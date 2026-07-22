<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Kursus $kursus)
    {
        $this->pastikanTerdaftar($kursus);

        $kursus->load(['moduls.materis']);

        // 1. Ambil semua ID materi dari kursus ini
        $materiIds = $kursus->moduls->flatMap->materis->pluck('id');
        $totalMateri = $materiIds->count();

        // 2. Hitung berapa materi dari kursus ini yang sudah dibuka (diselesaikan) oleh user
        $materiSelesai = auth()->user()
            ->materiSelesai()
            ->whereIn('materi_id', $materiIds)
            ->count();

        // 3. Hitung persentase
        $persentase = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        return view('peserta.materi.index', compact('kursus', 'totalMateri', 'materiSelesai', 'persentase'));
    }

    public function show(Materi $materi)
    {
        $materi->load('modul.kursus');
        $kursus = $materi->modul->kursus;

        $this->pastikanTerdaftar($kursus);

        // OTOMATIS TANDAI SELESAI
        // Jika materi ini belum ada di daftar materi selesai user, maka tambahkan
        $user = auth()->user();
        if (!$user->materiSelesai->contains($materi->id)) {
            $user->materiSelesai()->attach($materi->id);
        }

        return view('peserta.materi.show', compact('materi', 'kursus'));
    }

    private function pastikanTerdaftar(Kursus $kursus): void
    {
        $terdaftar = auth()->user()
            ->kursuses()
            ->where('kursus_id', $kursus->id)
            ->exists();

        abort_unless($terdaftar, 403, 'Kamu belum terdaftar di kursus ini.');
    }
}