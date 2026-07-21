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
        $kursuses = Kursus::with('kategori')->withCount('peserta')->latest()->get();
        return view('admin.kursus.index', compact('kursuses'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kursus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $this->validasi($request);
        $kategoriId = $this->resolveKategori($request);

        $data = [
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . Str::random(4),
            'kategori_id' => $kategoriId,
            'deskripsi' => $validated['deskripsi'],
            'status_kelas' => $validated['status_kelas'],
            'metode_belajar' => $validated['metode_belajar'] ?? null,
            'tingkat_kesiapan' => $validated['tingkat_kesiapan'] ?? null,
            'sertifikat' => $validated['sertifikat'] ?? null,
            'is_unggulan' => $request->boolean('is_unggulan'),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Kursus::create($data);

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
        $kursus = Kursus::findOrFail($id);
        $validated = $this->validasi($request);
        $kategoriId = $this->resolveKategori($request);

        $data = [
            'judul' => $validated['judul'],
            'kategori_id' => $kategoriId,
            'deskripsi' => $validated['deskripsi'],
            'status_kelas' => $validated['status_kelas'],
            'metode_belajar' => $validated['metode_belajar'] ?? null,
            'tingkat_kesiapan' => $validated['tingkat_kesiapan'] ?? null,
            'sertifikat' => $validated['sertifikat'] ?? null,
            'is_unggulan' => $request->boolean('is_unggulan'),
        ];

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $kursus->update($data);

        return redirect()->route('admin.kursus.index')->with('success', 'Data program pelatihan berhasil diedit');
    }

    public function destroy(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan berhasil dihapus');
    }

    private function validasi(Request $request): array
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'kategori_baru' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'status_kelas' => 'required|string|max:255',
            'metode_belajar' => 'nullable|string|max:255',
            'tingkat_kesiapan' => 'nullable|string|max:255',
            'sertifikat' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
        ]);
    }

    private function resolveKategori(Request $request): int
    {
        if ($request->filled('kategori_baru')) {
            $kategori = Kategori::create([
                'nama' => $request->kategori_baru,
                'slug' => Str::slug($request->kategori_baru),
            ]);
            return $kategori->id;
        }

        return (int) $request->kategori_id;
    }
}