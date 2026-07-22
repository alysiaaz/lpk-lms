<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kursus;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KursusController extends Controller
{
    /**
     * GET /api/kursus
     * List semua kursus dengan search, filter, dan pagination
     */
    public function index(Request $request): JsonResponse
    {
        $query = Kursus::with('kategori')->withCount('peserta');

        // Search
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

        // Pagination (default 15 per page)
        $perPage = $request->per_page ?? 15;
        $kursus = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $kursus->items(),
            'pagination' => [
                'total' => $kursus->total(),
                'per_page' => $kursus->perPage(),
                'current_page' => $kursus->currentPage(),
                'last_page' => $kursus->lastPage(),
                'from' => $kursus->firstItem(),
                'to' => $kursus->lastItem(),
            ],
        ]);
    }

    /**
     * GET /api/kursus/{slug}
     * Detail kursus dengan modul dan materi
     */
    public function show($slug): JsonResponse
    {
        $kursus = Kursus::with([
            'kategori',
            'moduls' => function ($q) {
                $q->with('materis')->orderBy('urutan');
            }
        ])
        ->withCount('peserta')
        ->where('slug', $slug)
        ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $kursus->id,
                'judul' => $kursus->judul,
                'slug' => $kursus->slug,
                'deskripsi' => $kursus->deskripsi,
                'harga' => $kursus->harga,
                'thumbnail' => asset('storage/' . $kursus->thumbnail),
                'status_kelas' => $kursus->status_kelas,
                'metode_belajar' => $kursus->metode_belajar,
                'tingkat_kesiapan' => $kursus->tingkat_kesiapan,
                'sertifikat' => $kursus->sertifikat,
                'is_unggulan' => $kursus->is_unggulan,
                'peserta_count' => $kursus->peserta_count,
                'kategori' => [
                    'id' => $kursus->kategori->id,
                    'nama' => $kursus->kategori->nama,
                    'slug' => $kursus->kategori->slug,
                ],
                'moduls' => $kursus->moduls->map(function ($modul) {
                    return [
                        'id' => $modul->id,
                        'judul_modul' => $modul->judul_modul,
                        'urutan' => $modul->urutan,
                        'materis' => $modul->materis->map(function ($materi) {
                            return [
                                'id' => $materi->id,
                                'judul_materi' => $materi->judul_materi,
                                'tipe' => $materi->tipe,
                                'file_path' => $materi->file_path ? asset('storage/' . $materi->file_path) : null,
                                'url_video' => $materi->url_video,
                                'urutan' => $materi->urutan,
                            ];
                        }),
                    ];
                }),
            ],
        ]);
    }

    /**
     * GET /api/kategori
     * List semua kategori
     */
    public function kategori(): JsonResponse
    {
        $kategoris = Kategori::withCount('kursuses')->get();

        return response()->json([
            'success' => true,
            'data' => $kategoris->map(function ($k) {
                return [
                    'id' => $k->id,
                    'nama' => $k->nama,
                    'slug' => $k->slug,
                    'jumlah_kursus' => $k->kursuses_count,
                ];
            }),
        ]);
    }

    /**
     * GET /api/kursus/unggulan
     * List kursus unggulan (featured)
     */
    public function unggulan(): JsonResponse
    {
        $kursus = Kursus::where('is_unggulan', true)
            ->with('kategori')
            ->withCount('peserta')
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $kursus,
        ]);
    }
}
