<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Menampilkan daftar ujian (Pre-test / Post-test) dalam suatu kursus.
     */
    public function index(Kursus $kursus)
    {
        $ujians = $kursus->ujians()->withCount('soals')->latest()->get();
        return view('admin.ujian.index', compact('kursus', 'ujians'));
    }

    /**
     * Menampilkan form tambah ujian baru.
     */
    public function create(Kursus $kursus)
    {
        return view('admin.ujian.create', compact('kursus'));
    }

    /**
     * Menyimpan ujian baru ke database.
     */
    public function store(Request $request, Kursus $kursus)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:pre-test,post-test',
            'waktu_menit' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        $kursus->ujians()->create($validated);

        return redirect()->route('admin.kursus.ujian.index', $kursus->id)
            ->with('success', 'Ujian berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit ujian.
     */
    public function edit(Kursus $kursus, Ujian $ujian)
    {
        return view('admin.ujian.edit', compact('kursus', 'ujian'));
    }

    /**
     * Memperbarui data ujian.
     */
    public function update(Request $request, Kursus $kursus, Ujian $ujian)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:pre-test,post-test',
            'waktu_menit' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ]);

        $ujian->update($validated);

        return redirect()->route('admin.kursus.ujian.index', $kursus->id)
            ->with('success', 'Data ujian berhasil diperbarui!');
    }

    /**
     * Menghapus ujian beserta soal dan opsinya.
     */
    public function destroy(Kursus $kursus, Ujian $ujian)
    {
        $ujian->delete();

        return redirect()->route('admin.kursus.ujian.index', $kursus->id)
            ->with('success', 'Ujian berhasil dihapus!');
    }
}