<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Mengambil kursus unggulan untuk rekomendasi belajar peserta
        $rekomendasiKursus = Kursus::with('kategori')->withCount('peserta')->latest()->take(3)->get();

        return view('peserta.dashboard', compact('user', 'rekomendasiKursus'));
    }

    public function kursusSaya()
    {
        return view('peserta.kursus-saya');
    }
}
