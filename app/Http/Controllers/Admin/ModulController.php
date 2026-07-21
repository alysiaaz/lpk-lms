<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index($kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $moduls = Modul::where('kursus_id', $kursusId)->orderBy('urutan')->get();

        return view('admin.modul.index', compact('kursus', 'moduls'));
    }

    public function create($kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        // default urutan otomatis = jumlah modul yang sudah ada + 1
        $urutanBerikutnya = Modul::where('kursus_id', $kursusId)->max('urutan') + 1;

        return view('admin.modul.create', compact('kursus', 'urutanBerikutnya'));
    }

    public function store(Request $request, $kursusId)
    {
        $kursus = Kursus::findOrFail($kursusId);

        $validated = $request->validate([
            'judul_modul' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1',
        ]);

        $kursus->moduls()->create($validated);

        return redirect()->route('admin.kursus.modul.index', $kursus->id)
            ->with('success', 'Modul berhasil ditambahkan.');
    }

    public function edit($kursusId, $modulId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);

        return view('admin.modul.edit', compact('kursus', 'modul'));
    }

    public function update(Request $request, $kursusId, $modulId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);

        $validated = $request->validate([
            'judul_modul' => 'required|string|max:255',
            'urutan' => 'required|integer|min:1',
        ]);

        $modul->update($validated);

        return redirect()->route('admin.kursus.modul.index', $kursus->id)
            ->with('success', 'Modul berhasil diperbarui.');
    }

    public function destroy($kursusId, $modulId)
    {
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);
        $modul->delete();

        return redirect()->route('admin.kursus.modul.index', $kursusId)
            ->with('success', 'Modul berhasil dihapus.');
    }
}
