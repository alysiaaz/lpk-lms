<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\NilaiPeserta;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function show(Kursus $kursus)
    {
        $user = auth()->user();
        $tanggal_lulus = now()->translatedFormat('d F Y'); 

        // Ambil nilai ujian Post-Test peserta dengan pencarian fleksibel
        $hasilUjian = NilaiPeserta::where('user_id', $user->id)
            ->whereHas('ujian', function($q) use ($kursus) {
                $q->where('kursus_id', $kursus->id)
                  ->whereIn('tipe', ['post-test', 'post_test', 'posttest']);
            })
            ->latest()
            ->first();

        // Proteksi: Jika belum ada hasil ujian post-test, arahkan kembali
        if (!$hasilUjian) {
            return redirect()->back()->with('error', 'Anda harus menyelesaikan Post-Test terlebih dahulu untuk mendapatkan sertifikat.');
        }

        $skor = $hasilUjian->skor; // Nilai peserta

        // Pilihan Model Berdasarkan pengaturan Admin pada Kursus
        if ($kursus->sertifikat === 'Sertifikat Kompetensi + Nilai') {
            return view('peserta.sertifikat.model_kompetensi', compact('kursus', 'user', 'tanggal_lulus', 'skor'));
        } 
        elseif ($kursus->sertifikat === 'Tidak Ada Sertifikat') {
            return redirect()->back()->with('error', 'Kursus ini tidak menyediakan sertifikat kelulusan.');
        }

        // Default Model A: Sertifikat Penyelesaian Standar
        return view('peserta.sertifikat.show', compact('kursus', 'user', 'tanggal_lulus', 'skor'));
    }
}