<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    /**
     * Daftarkan peserta yang sedang login ke kursus tertentu.
     */
    public function store(Kursus $kursus): RedirectResponse
    {
        $user = auth()->user();

        // Hanya peserta yang boleh mendaftar kursus (admin tidak perlu)
        if ($user->role !== 'peserta') {
            return redirect()->back()->with('error', 'Hanya peserta yang dapat mendaftar kursus.');
        }

        // Cegah dobel daftar di kursus yang sama
        if ($user->kursuses()->where('kursus_id', $kursus->id)->exists()) {
            return redirect()->route('peserta.kursus')
                ->with('info', 'Kamu sudah terdaftar di kursus "' . $kursus->judul . '".');
        }

        $user->kursuses()->attach($kursus->id, ['status' => 'aktif']);

        return redirect()->route('peserta.kursus')
            ->with('success', 'Berhasil mendaftar kursus "' . $kursus->judul . '"!');
    }
}
