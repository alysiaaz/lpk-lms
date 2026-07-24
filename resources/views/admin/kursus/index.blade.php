@extends('layouts.admin')
@section('page-title', 'Manajemen Kursus')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-admin-text">Pusat Kontrol Kursus & Ujian</h1>
            <p class="text-sm text-admin-muted mt-1">Kelola silabus materi, pre-test, dan post-test untuk semua kursus.</p>
        </div>
        <a href="{{ route('admin.kursus.create') }}" class="inline-flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Kursus Baru
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($kursuses as $kursus)
        <div class="bg-white p-6 rounded-2xl border border-admin-border shadow-sm hover:shadow-md hover:-translate-y-0.5 transition flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-bold text-admin-text mb-2">{{ $kursus->judul }}</h2>
                <p class="text-admin-muted text-sm mb-5 line-clamp-2">{{ $kursus->deskripsi }}</p>
            </div>

            <!-- KUMPULAN TOMBOL AKSI -->
            <div class="space-y-2 pt-4 border-t border-admin-border/60">
                <!-- Baris 1: Edit Silabus & Kelola Ujian (Tombol Utama) -->
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('admin.kursus.modul.index', $kursus->id) }}" class="text-center bg-admin-navy text-white hover:bg-admin-navy-2 py-2 rounded-lg font-semibold text-xs transition flex items-center justify-center gap-1 shadow-sm">
                        Silabus
                    </a>
                    
                    <!-- INI TOMBOL KELOLA UJIAN YANG TAMBAHKAN -->
                    <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="text-center bg-admin-accent text-white hover:bg-admin-accent-dark py-2 rounded-lg font-semibold text-xs transition flex items-center justify-center gap-1 shadow-sm">
                        Kelola Ujian
                    </a>
                </div>

                <!-- Baris 2: Edit Detail & Hapus -->
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('admin.kursus.edit', $kursus->id) }}" class="text-center bg-admin-bg hover:bg-gray-200 text-admin-text py-2 rounded-lg font-semibold text-xs transition flex items-center justify-center gap-1">
                        Edit Detail
                    </a>

                    <form action="{{ route('admin.kursus.destroy', $kursus->id) }}" method="POST" class="m-0" onsubmit="return confirm('Hapus kursus {{ $kursus->judul }}? Data peserta yang terdaftar di kursus ini juga akan ikut terhapus.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full text-center bg-red-50 hover:bg-red-500 hover:text-white text-red-600 py-2 rounded-lg font-semibold text-xs transition flex items-center justify-center gap-1">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
        @endforeach
    </div>
</div>
@endsection