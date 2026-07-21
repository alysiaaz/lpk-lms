<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kursus;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Kursus::with('peserta')
            ->get()
            ->flatMap(function ($kursus) {
                return $kursus->peserta->map(function ($peserta) use ($kursus) {
                    return (object) [
                        'peserta' => $peserta,
                        'kursus' => $kursus,
                        'status' => $peserta->pivot->status,
                        'tanggal' => $peserta->pivot->created_at,
                    ];
                });
            })
            ->sortByDesc('tanggal')
            ->values();

        return view('admin.enrollments.index', compact('enrollments'));
    }
}
