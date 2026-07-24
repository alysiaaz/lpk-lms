@extends('layouts.admin')
@section('title', 'Kelola Soal - ' . $ujian->judul)
@section('page-title', 'Daftar Butir Soal')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="text-xs font-bold text-admin-navy hover:underline">&larr; Kembali ke Daftar Ujian</a>
            <h1 class="text-2xl font-black text-admin-navy mt-1">{{ $ujian->judul }}</h1>
            <p class="text-sm text-gray-500 font-medium">Total Soal Saat Ini: {{ $soals->count() }} butir</p>
        </div>
        <div>
            <a href="{{ route('admin.kursus.ujian.soal.create', [$kursus->id, $ujian->id]) }}" class="inline-flex items-center gap-2 bg-admin-accent hover:bg-admin-accent-dark text-white text-sm font-extrabold px-6 py-3.5 rounded-full shadow transition">
                <span>+ Tambah Soal Baru</span>
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 font-bold text-sm p-4 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Soal -->
    <div class="space-y-4">
        @forelse($soals as $soal)
            <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm space-y-4">
                <div class="flex items-start justify-between gap-4 border-b border-gray-100 pb-4">
                    <div class="flex items-start gap-3">
                        <span class="w-8 h-8 rounded-full bg-admin-navy text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">{{ $loop->iteration }}</span>
                        <h3 class="font-bold text-base text-admin-navy">{{ $soal->pertanyaan }}</h3>
                    </div>
                    
                    <form action="{{ route('admin.kursus.ujian.soal.destroy', [$kursus->id, $ujian->id, $soal->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-xl text-xs font-bold transition">🗑️ Hapus</button>
                    </form>
                </div>

                <!-- Pilihan Ganda -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-11">
                    @foreach($soal->opsis as $opsi)
                        <div class="p-3.5 rounded-2xl border text-sm flex items-center justify-between {{ $opsi->is_benar ? 'bg-green-50 border-green-400 text-green-900 font-bold' : 'bg-gray-50 border-gray-200 text-gray-600' }}">
                            <span>{{ $opsi->teks_pilihan }}</span>
                            @if($opsi->is_benar)
                                <span class="text-xs bg-green-600 text-white px-2.5 py-1 rounded-lg uppercase tracking-wider font-extrabold">Kunci Jawaban ✓</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white rounded-3xl border border-gray-200 p-12 text-center space-y-3">
                <p class="text-3xl">📋</p>
                <h3 class="font-bold text-lg text-admin-navy">Belum Ada Soal</h3>
                <p class="text-sm text-gray-500">Klik tombol di atas untuk menambahkan butir pertanyaan beserta kunci jawabannya.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection