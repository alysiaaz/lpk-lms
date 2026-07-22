<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    /**
     * Daftar modul & materi untuk sebuah kursus yang sedang diikuti peserta.
     */
    public function index(Kursus $kursus)
    {
        $this->pastikanTerdaftar($kursus);

        $kursus->load(['moduls.materis']);

        return view('peserta.materi.index', compact('kursus'));
    }

    /**
     * Halaman viewer untuk satu materi (PDF/video).
     */
    public function show(Materi $materi)
    {
        $materi->load('modul.kursus');
        $kursus = $materi->modul->kursus;

        $this->pastikanTerdaftar($kursus);

        return view('peserta.materi.show', compact('materi', 'kursus'));
    }

    /**
     * Pastikan peserta yang login sudah terdaftar (enroll) pada kursus ini.
     * Kalau belum, tolak akses dan arahkan ke halaman kursus.
     */
    private function pastikanTerdaftar(Kursus $kursus): void
    {
        $terdaftar = auth()->user()
            ->kursuses()
            ->where('kursus_id', $kursus->id)
            ->exists();

        abort_unless($terdaftar, 403, 'Kamu belum terdaftar di kursus ini.');
    }
}
