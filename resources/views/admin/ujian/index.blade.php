@extends('layouts.admin')
@section('title', 'Kelola Ujian - ' . $kursus->judul)

@section('content')
<div class="space-y-6">

    <!-- Header & Tombol Kembali -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <a href="{{ route('admin.kursus.index') }}" class="text-xs font-bold text-admin-accent hover:underline">&larr; Kembali ke Daftar Kursus</a>
            <h1 class="text-2xl font-black text-admin-navy mt-1">Kelola Ujian Kursus</h1>
            <p class="text-sm text-gray-500 font-medium">{{ $kursus->judul }}</p>
        </div>
        <div>
            <a href="{{ route('admin.kursus.ujian.create', $kursus->id) }}" class="inline-flex items-center gap-2 bg-admin-navy hover:bg-admin-navy-2 text-white text-sm font-extrabold px-6 py-3.5 rounded-full shadow transition">
                <span>+ Tambah Ujian Baru</span>
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 font-bold text-sm p-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Ujian -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($ujians as $ujian)
            <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm flex flex-col justify-between gap-6 relative overflow-hidden">
                <!-- Badge Tipe Ujian -->
                <div class="flex items-center justify-between gap-2">
                    <span class="inline-block px-3.5 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $ujian->tipe === 'pre-test' ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-emerald-100 text-emerald-800 border border-emerald-300' }}">
                        {{ $ujian->tipe === 'pre-test' ? '📝 Pre-Test (Tahap Awal)' : '🎓 Post-Test (Tahap Akhir)' }}
                    </span>
                    <span class="text-xs font-bold text-gray-400">⏱️ {{ $ujian->waktu_menit }} Menit</span>
                </div>

                <!-- Info Ujian -->
                <div class="space-y-2">
                    <h3 class="text-xl font-extrabold text-admin-navy">{{ $ujian->judul }}</h3>
                    <p class="text-xs text-gray-500 line-clamp-2">{{ $ujian->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1 bg-gray-100 text-admin-text font-bold text-xs px-3 py-1.5 rounded-xl">
                            📋 Total Soal: <strong class="text-admin-navy">{{ $ujian->soals_count }} butir</strong>
                        </span>
                    </div>
                </div>

                <!-- Tombol Aksi (Kelola Soal, Edit, Hapus) -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                    <a href="{{ route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id]) }}" class="flex-1 text-center bg-admin-navy hover:bg-admin-navy-2 text-white text-xs font-extrabold py-3 px-4 rounded-xl transition shadow-sm">
                        Kelola Soal (&nbsp;{{ $ujian->soals_count }}&nbsp;)
                    </a>
                    
                    <div class="flex items-center gap-1">
                        <a href="{{ route('admin.kursus.ujian.edit', [$kursus->id, $ujian->id]) }}" title="Edit Ujian" class="p-3 bg-gray-100 hover:bg-gray-200 text-admin-navy rounded-xl transition font-bold text-xs">
                            ✏️ Edit
                        </a>
                        
                        <form action="{{ route('admin.kursus.ujian.destroy', [$kursus->id, $ujian->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ujian ini beserta seluruh soal di dalamnya?');" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus Ujian" class="p-3 bg-red-50 hover:bg-red-500 hover:text-white text-red-600 rounded-xl transition font-bold text-xs">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-4">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-2xl">📝</div>
                <h3 class="font-bold text-lg text-admin-navy">Belum Ada Ujian</h3>
                <p class="text-sm text-gray-500 max-w-md mx-auto">Kursus ini belum memiliki Pre-test maupun Post-test. Silakan klik tombol di bawah untuk mulai membuat ujian.</p>
                <a href="{{ route('admin.kursus.ujian.create', $kursus->id) }}" class="inline-block bg-admin-navy text-white text-xs font-extrabold px-6 py-3 rounded-full shadow">
                    + Buat Ujian Pertama
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection