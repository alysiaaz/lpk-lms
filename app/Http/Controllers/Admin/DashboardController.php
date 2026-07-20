<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKursus = Kursus::count();
        $totalPeserta = User::where('role', 'peserta')->count();
        $totalKategori = Kategori::count();
        $kursusTerbaru = Kursus::with('kategori')->withCount('peserta')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalKursus', 'totalPeserta', 'totalKategori', 'kursusTerbaru'));
    }
}
