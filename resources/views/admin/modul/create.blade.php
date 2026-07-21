@extends('layouts.admin')
@section('page-title', 'Tambah Modul')

@section('content')
<div class="max-w-xl space-y-4">
    <a href="{{ route('admin.kursus.modul.index', $kursus->id) }}" class="text-sm text-admin-accent font-medium hover:underline">&larr; Kembali ke Silabus</a>

    <div class="bg-white p-8 rounded-2xl border border-admin-border shadow-sm">
        <h2 class="text-xl font-bold text-admin-text mb-1">Tambah Modul Baru</h2>
        <p class="text-sm text-admin-muted mb-6">Untuk kursus: <span class="font-semibold text-admin-text">{{ $kursus->judul }}</span></p>

        <form action="{{ route('admin.kursus.modul.store', $kursus->id) }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Judul Modul</label>
                <input type="text" name="judul_modul" value="{{ old('judul_modul') }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" placeholder="Contoh: Pengenalan HTML & CSS">
                @error('judul_modul') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Urutan</label>
                <input type="number" name="urutan" min="1" value="{{ old('urutan', $urutanBerikutnya) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                <p class="text-xs text-admin-muted mt-1">Menentukan posisi modul ini dalam daftar silabus (1 = paling atas).</p>
                @error('urutan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button class="bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition">Simpan Modul</button>
        </form>
    </div>
</div>
@endsection
