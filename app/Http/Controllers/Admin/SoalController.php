<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Ujian;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    /**
     * Menampilkan daftar soal dalam sebuah ujian.
     */
    public function index(Kursus $kursus, Ujian $ujian)
    {
        $soals = $ujian->soals()->with('opsis')->latest()->get();
        return view('admin.soal.index', compact('kursus', 'ujian', 'soals'));
    }

    /**
     * Menampilkan form tambah soal beserta pilihan gandanya.
     */
    public function create(Kursus $kursus, Ujian $ujian)
    {
        return view('admin.soal.create', compact('kursus', 'ujian'));
    }

    /**
     * Menyimpan soal dan 4 pilihan ganda sekaligus menggunakan Database Transaction.
     */
    public function store(Request $request, Kursus $kursus, Ujian $ujian)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi.*' => 'required|string', // Array 4 opsi
            'jawaban_benar' => 'required|integer|min:0|max:3', // Indeks opsi yang benar (0, 1, 2, atau 3)
        ]);

        DB::transaction(function () use ($request, $ujian) {
            // 1. Simpan soal
            $soal = $ujian->soals()->create([
                'pertanyaan' => $request->pertanyaan
            ]);

            foreach ($request->opsi as $index => $teksOpsi) {
                $soal->opsis()->create([
                    'teks_pilihan' => $teksOpsi,
                    'is_benar' => ($index == $request->jawaban_benar)
                ]);
            }
        });

        return redirect()->route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id])
            ->with('success', 'Soal dan pilihan ganda berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit soal.
     */
    public function edit(Kursus $kursus, Ujian $ujian, Soal $soal)
    {
        $soal->load('opsis');
        return view('admin.soal.edit', compact('kursus', 'ujian', 'soal'));
    }

    /**
     * Memperbarui soal dan pilihan gandanya.
     */
    public function update(Request $request, Kursus $kursus, Ujian $ujian, Soal $soal)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_id.*' => 'required|exists:opsis,id',
            'opsi.*' => 'required|string',
            'jawaban_benar' => 'required|integer|min:0|max:3',
        ]);

        DB::transaction(function () use ($request, $soal) {

            $soal->update(['pertanyaan' => $request->pertanyaan]);

            $soal->load('opsis');
            foreach ($soal->opsis as $index => $opsi) {
                $opsi->update([
                    'teks_pilihan' => $request->opsi[$index],
                    'is_benar' => ($index == $request->jawaban_benar)
                ]);
            }
        });

        return redirect()->route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id])
            ->with('success', 'Soal berhasil diperbarui!');
    }

    /**
     * Menghapus soal beserta pilihan gandanya.
     */
    public function destroy(Kursus $kursus, Ujian $ujian, Soal $soal)
    {
        $soal->delete();

        return redirect()->route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id])
            ->with('success', 'Soal berhasil dihapus!');
    }
}