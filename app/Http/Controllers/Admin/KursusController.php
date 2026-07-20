<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Modelds\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KursusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kursus = Kursus::with('kategori')->withCount('peserta')->latest()->get();
        return view('admin.kursus.index', compact('kursus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.kursus.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exist:kategori,id',
            'deskripsi' => 'required|string',
        ]);

        Kursus::create([
            'judul' => $validate['judul'],
            'slug' => Str::slug($validate['judul']) . '_' . Str::random(4),
            'kategori_id' => $validate['kategori_id'],
            'deskripsi' => $validate['deskripsi'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.kurus.edit', compact('kursus', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exist:kategori,id',
            'deskripsi' => 'required|string',
        ]);

        $kursus = Kursus::findOrFail($id);
        $kursus->update([
            'judul' => $validate['judul'],
            'slug' => Str::slug($validate['judul']) . '_' . Str::random(4),
            'kategori_id' => $validate['kategori_id'],
            'deskripsi' => $validate['deskripsi'],
        ]);

        return redirect()->route('admin.kursus.index')->with('success', 'Data program pelatihan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kursus = Kursus::findorFail($id);
        $kursus->delete();

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan berhasil dihapus');
    }
}
