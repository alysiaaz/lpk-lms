<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KursusController extends Controller
{
    public function index()
    {
        $kursuses = Kursus::with('kategori')->latest()->get();
        return view('admin.kursus.index', compact('kursuses'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kursus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'status_kelas' => 'required|string',
            'metode_belajar' => 'required|string',
            'tingkat_kesiapan' => 'required|string',
            'sertifikat' => 'required|string',
        ]);

        Kursus::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . Str::random(4),
            'kategori_id' => $validated['kategori_id'],
            'deskripsi' => $validated['deskripsi'],
            'status_kelas' => $validated['status_kelas'],
            'metode_belajar' => $validated['metode_belajar'],
            'tingkat_kesiapan' => $validated['tingkat_kesiapan'],
            'sertifikat' => $validated['sertifikat'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.kursus.edit', compact('kursus', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'status_kelas' => 'required|string',
            'metode_belajar' => 'required|string',
            'tingkat_kesiapan' => 'required|string',
            'sertifikat' => 'required|string',
        ]);

        $kursus = Kursus::findOrFail($id);
        $kursus->update([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . Str::random(4),
            'kategori_id' => $validated['kategori_id'],
            'deskripsi' => $validated['deskripsi'],
            'status_kelas' => $validated['status_kelas'],
            'metode_belajar' => $validated['metode_belajar'],
            'tingkat_kesiapan' => $validated['tingkat_kesiapan'],
            'sertifikat' => $validated['sertifikat'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Kursus berhasil dihapus');
    }
}