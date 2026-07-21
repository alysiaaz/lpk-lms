<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kursus;

class BerandaController extends Controller
{
    public function index()
    {
        $kursusUnggulan = Kursus::with('kategori')
                                ->withCount('peserta')
                                ->where('is_unggulan', true)
                                ->latest()
                                ->take(3)
                                ->get();
        return view('publik.beranda', compact('kursusUnggulan'));
    }
}
