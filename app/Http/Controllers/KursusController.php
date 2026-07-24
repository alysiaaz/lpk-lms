<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index(Request $request)
    {
        // Query kursus dengan search, filter, dan pagination
        $query = Kursus::with('kategori')->withCount('peserta');

        // Search by judul atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Sort/ordering
        if ($request->filled('sort')) {
            match ($request->sort) {
                'terbaru' => $query->latest(),
                'terlama' => $query->oldest(),
                'paling-diminati' => $query->withCount('peserta')->orderByDesc('peserta_count'),
                'harga-murah' => $query->orderBy('harga'),
                'harga-mahal' => $query->orderByDesc('harga'),
                default => $query->latest(),
            };
        }

        // Pagination: 12 kursus per halaman
        $semuaKursus = $query->paginate(12);

        // Data untuk filter UI
        $kategoris = Kategori::all();
        $kursusUnggulan = Kursus::with('kategori')
            ->where('is_unggulan', true)
            ->latest()
            ->take(6)
            ->get();

        return view('publik.katalog', compact('semuaKursus', 'kategoris', 'kursusUnggulan'));
    }

    public function show($slug)
    {
        $kursus = Kursus::with('kategori')->where('slug', $slug)->firstOrFail();

        // kursus terkait di halaman detail
        $kursusTerkait = Kursus::with('kategori')
            ->where('kategori_id', $kursus->kategori_id)
            ->where('id', '!=', $kursus->id)
            ->take(3)
            ->get();

        return view('publik.detail-kursus', compact('kursus', 'kursusTerkait'));
    }

    public function destroy(string $id)
    {
        $kursus = Kursus::findOrFail($id);
        $kursus->delete(); 

        return redirect()->route('admin.kursus.index')->with('success', 'Program pelatihan dan seluruh data terkait berhasil dihapus bersih.');
    }
}