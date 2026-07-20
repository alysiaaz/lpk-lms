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
        $kursus = Kursus::with('kategori')->withCount('peserta')->latest()->get();
        return view('admin.kursus.index', compact('kursus'));
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
        ]);

        Kursus::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '_' . Str::random(4),
            'kategori_id' => $validated['kategori_id'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan baru berhasil ditambahkan');
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
        ]);

        $kursus = Kursus::findOrFail($id);
        $kursus->update([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '_' . Str::random(4),
            'kategori_id' => $validated['kategori_id'],
            'deskripsi' => $validated['deskripsi'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Data program pelatihan berhasil diedit');
    }

    public function destroy(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan berhasil dihapus');
    }
}