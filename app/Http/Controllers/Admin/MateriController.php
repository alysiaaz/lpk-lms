<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Materi;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index($kursusId, $modulId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);
        $materis = Materi::where('modul_id', $modulId)->orderBy('urutan')->get();

        return view('admin.materi.index', compact('kursus', 'modul', 'materis'));
    }

    public function create($kursusId, $modulId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);
        $urutanBerikutnya = Materi::where('modul_id', $modulId)->max('urutan') + 1;

        return view('admin.materi.create', compact('kursus', 'modul', 'urutanBerikutnya'));
    }

    public function store(Request $request, $kursusId, $modulId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'tipe' => 'required|in:pdf,video',
            'urutan' => 'required|integer|min:1',
            'sumber_video' => 'required_if:tipe,video|nullable|in:upload,link',
            'file_pdf' => 'nullable|file|max:51200|mimes:pdf',
            'file_video' => 'nullable|file|max:51200|mimes:mp4,mov,avi,webm',
            'url_video' => 'nullable|url|max:255',
        ]);

        // Validasi manual: pastikan sumber konten sesuai tipe yang dipilih
        if ($validated['tipe'] === 'pdf' && !$request->hasFile('file_pdf')) {
            return back()->withErrors(['file_pdf' => 'File PDF wajib diupload.'])->withInput();
        }
        if ($validated['tipe'] === 'video') {
            if ($request->sumber_video === 'upload' && !$request->hasFile('file_video')) {
                return back()->withErrors(['file_video' => 'File video wajib diupload.'])->withInput();
            }
            if ($request->sumber_video === 'link' && empty($validated['url_video'])) {
                return back()->withErrors(['url_video' => 'Link video wajib diisi.'])->withInput();
            }
        }

        $data = [
            'modul_id' => $modul->id,
            'judul_materi' => $validated['judul_materi'],
            'tipe' => $validated['tipe'],
            'urutan' => $validated['urutan'],
            'file_path' => null,
            'url_video' => null,
        ];

        if ($validated['tipe'] === 'pdf' && $request->hasFile('file_pdf')) {
            $data['file_path'] = $request->file('file_pdf')->store('materi/pdf', 'public');
        } elseif ($validated['tipe'] === 'video' && $request->sumber_video === 'upload' && $request->hasFile('file_video')) {
            $data['file_path'] = $request->file('file_video')->store('materi/video', 'public');
        } elseif ($validated['tipe'] === 'video' && $request->sumber_video === 'link') {
            $data['url_video'] = $validated['url_video'];
        }

        Materi::create($data);

        return redirect()->route('admin.kursus.modul.materi.index', [$kursus->id, $modul->id])
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit($kursusId, $modulId, $materiId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);
        $materi = Materi::where('modul_id', $modulId)->findOrFail($materiId);

        return view('admin.materi.edit', compact('kursus', 'modul', 'materi'));
    }

    public function update(Request $request, $kursusId, $modulId, $materiId)
    {
        $kursus = Kursus::findOrFail($kursusId);
        $modul = Modul::where('kursus_id', $kursusId)->findOrFail($modulId);
        $materi = Materi::where('modul_id', $modulId)->findOrFail($materiId);

        $validated = $request->validate([
            'judul_materi' => 'required|string|max:255',
            'tipe' => 'required|in:pdf,video',
            'urutan' => 'required|integer|min:1',
            'sumber_video' => 'required_if:tipe,video|nullable|in:upload,link',
            'file_pdf' => 'nullable|file|max:51200|mimes:pdf',
            'file_video' => 'nullable|file|max:51200|mimes:mp4,mov,avi,webm',
            'url_video' => 'nullable|url|max:255',
        ]);

        $data = [
            'judul_materi' => $validated['judul_materi'],
            'tipe' => $validated['tipe'],
            'urutan' => $validated['urutan'],
        ];

        $fileBaruDiupload = ($validated['tipe'] === 'pdf' && $request->hasFile('file_pdf'))
            || ($validated['tipe'] === 'video' && $request->sumber_video === 'upload' && $request->hasFile('file_video'));

        if ($fileBaruDiupload) {
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            if ($validated['tipe'] === 'pdf') {
                $data['file_path'] = $request->file('file_pdf')->store('materi/pdf', 'public');
            } else {
                $data['file_path'] = $request->file('file_video')->store('materi/video', 'public');
            }
            $data['url_video'] = null;
        } elseif ($validated['tipe'] === 'video' && $request->sumber_video === 'link') {
            if (empty($validated['url_video'])) {
                return back()->withErrors(['url_video' => 'Link video wajib diisi.'])->withInput();
            }
            if ($materi->file_path) {
                Storage::disk('public')->delete($materi->file_path);
            }
            $data['file_path'] = null;
            $data['url_video'] = $validated['url_video'];
        }

        $materi->update($data);

        return redirect()->route('admin.kursus.modul.materi.index', [$kursus->id, $modul->id])
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($kursusId, $modulId, $materiId)
    {
        $materi = Materi::where('modul_id', $modulId)->findOrFail($materiId);

        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('admin.kursus.modul.materi.index', [$kursusId, $modulId])
            ->with('success', 'Materi berhasil dihapus.');
    }
}
