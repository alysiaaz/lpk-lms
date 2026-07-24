<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\NilaiPeserta;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Menampilkan halaman ujian beserta soal-soalnya kepada peserta.
     */
    public function show(Ujian $ujian)
    {
        $user = auth()->user();

        // Cek apakah user sudah terdaftar di kursus yang memiliki ujian ini
        $terdaftar = $user->kursuses()->where('kursus_id', $ujian->kursus_id)->exists();
        abort_unless($terdaftar, 403, 'Kamu belum terdaftar di kursus ini.');

        // Cek apakah user sudah pernah mengerjakan ujian ini sebelumnya
        $nilai = NilaiPeserta::where('user_id', $user->id)
                    ->where('ujian_id', $ujian->id)
                    ->first();

        // Load soal beserta opsinya secara acak agar setiap peserta mendapat urutan berbeda
        $ujian->load(['soals' => function($q) {
            $q->inRandomOrder()->with(['opsis' => function($qOpsi) {
                $qOpsi->inRandomOrder();
            }]);
        }]);

        return view('peserta.ujian.show', compact('ujian', 'nilai'));
    }

    /**
     * Memproses jawaban peserta, menghitung skor, dan menyimpannya.
     */
    public function submit(Request $request, Ujian $ujian)
    {
        $user = auth()->user();

        // Ambil semua soal dari ujian ini beserta opsinya
        $ujian->load('soals.opsis');
        $totalSoal = $ujian->soals->count();

        if ($totalSoal === 0) {
            return back()->with('error', 'Soal ujian belum tersedia.');
        }

        $jawabanBenar = 0;

        // Loop setiap soal untuk mencocokkan jawaban dari form
        foreach ($ujian->soals as $soal) {
            // $request->input('soal_1'), $request->input('soal_2'), dst. berisi id dari opsi yang dipilih
            $opsiDipilihId = $request->input('soal_' . $soal->id);

            if ($opsiDipilihId) {
                $opsi = $soal->opsis->where('id', $opsiDipilihId)->first();
                if ($opsi && $opsi->is_benar) {
                    $jawabanBenar++;
                }
            }
        }

        // Hitung skor skala 100
        $skorAkhir = round(($jawabanBenar / $totalSoal) * 100);

        // Simpan atau perbarui nilai peserta ke database
        NilaiPeserta::updateOrCreate(
            [
                'user_id' => $user->id,
                'ujian_id' => $ujian->id,
            ],
            [
                'skor' => $skorAkhir,
            ]
        );

        return redirect()->route('peserta.ujian.show', $ujian->id)
            ->with('success', "Ujian selesai! Kamu mendapatkan skor $skorAkhir dari 100.");
    }
}
