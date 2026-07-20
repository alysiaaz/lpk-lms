<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Kategori;

class KursusController extends Controller
{
    public function index(Request $request)
    {
        $query = Kursus::with('kategori')->withCount('peserta');

        //Melakukan pencarian menggunakan kotak search
       if ($request->has('q') && $request->q != '') {
            $query->where('judul', 'like', '%' . $request->q . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->q . '%');
        }

        //Menggunakan filter
        if($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $semuaKursus = $query->latest()->get();
        $kategoris = Kategori::all();

        return view('publik.katalog', compact('semuaKursus', 'kategoris'));
    }

    public function show($slug)
    {
        $kursus = Kursus::with('kategori')->withCount('peserta')->where('slug', $slug)->firstOrFail();
        
        $kursusLain = Kursus::with('kategori')
                            ->where('kategori_id', $kursus->kategori_id)
                            ->where('id', '!=', $kursus->id)
                            ->take(3)
                            ->get();

        return view('publik.detail-kursus', compact('kursus', 'kursusLain'));
    }
}
