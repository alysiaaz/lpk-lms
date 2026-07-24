<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use App\Models\NilaiPeserta;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index(Kursus $kursus)
    {
        $this->pastikanTerdaftar($kursus);

        // Load modul, materi, dan juga ujian (pre-test & post-test) dari kursus ini
        $kursus->load(['moduls.materis', 'ujians']);

        // ID materi dari kursus ini
        $materiIds = $kursus->moduls->flatMap->materis->pluck('id');
        $totalMateri = $materiIds->count();

        // materi dari kursus ini yang sudah diselesaikan oleh user
        $materiSelesai = auth()->user()
            ->materiSelesai()
            ->whereIn('materi_id', $materiIds)
            ->count();

        // persentase
        $persentase = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        // Cek apakah peserta sudah lulus post-test pada kursus ini
        $sudahLulusPostTest = NilaiPeserta::where('user_id', auth()->id())
            ->whereHas('ujian', function($q) use ($kursus) {
                $q->where('kursus_id', $kursus->id)->where('tipe', 'post-test');
            })
            ->exists();

        return view('peserta.materi.index', compact('kursus', 'totalMateri', 'materiSelesai', 'persentase', 'sudahLulusPostTest'));
    }

    public function show(Materi $materi)
    {
        $materi->load('modul.kursus');
        $kursus = $materi->modul->kursus;

        $this->pastikanTerdaftar($kursus);

        // OTOMATIS TANDAI SELESAI
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