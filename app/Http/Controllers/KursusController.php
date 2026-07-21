<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function beranda()
    {
        $kursusUnggulan = Kursus::with('kategori')
            ->where('is_unggulan', true)
            ->latest()
            ->take(6) 
            ->get();

        return view('beranda', compact('kursusUnggulan'));
    }

    public function index(Request $request)
    {
        $semuaKursus = Kursus::with('kategori')->latest()->get();
        $kategoris = Kategori::all();
        $kursusUnggulan = Kursus::with('kategori')
            ->where('is_unggulan', true)
            ->latest()
            ->get();

        return view('publik.katalog', compact('semuaKursus', 'kategoris', 'kursusUnggulan'));
    }

    public function show($slug)
    {
        $kursus = Kursus::with('kategori')->where('slug', $slug)->firstOrFail();

       // kursus terkait pd halaman detail
        $kursusTerkait = Kursus::with('kategori')
            ->where('kategori_id', $kursus->kategori_id)
            ->where('id', '!=', $kursus->id)
            ->take(3)
            ->get();

        return view('publik.detail-kursus', compact('kursus', 'kursusTerkait'));
    }
}