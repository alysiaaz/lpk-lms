@extends('layouts.admin')
@section('content')
<div class="max-w-xl space-y-4">
    <a href="{{ route('admin.kursus.modul.index', $kursus->id) }}" class="text-sm text-lpk-teal hover:underline">&larr; Kembali ke Silabus</a>

    <div class="bg-white p-8 rounded-2xl shadow">
        <h2 class="text-2xl font-bold text-lpk-teal mb-1">Tambah Modul Baru</h2>
        <p class="text-sm text-gray-500 mb-6">Untuk kursus: <span class="font-semibold">{{ $kursus->judul }}</span></p>

        <form action="{{ route('admin.kursus.modul.store', $kursus->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-bold mb-1">Judul Modul</label>
                <input type="text" name="judul_modul" value="{{ old('judul_modul') }}" class="w-full border p-2 rounded" placeholder="Contoh: Pengenalan HTML & CSS">
                @error('judul_modul') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block font-bold mb-1">Urutan</label>
                <input type="number" name="urutan" min="1" value="{{ old('urutan', $urutanBerikutnya) }}" class="w-full border p-2 rounded">
                <p class="text-xs text-gray-500 mt-1">Menentukan posisi modul ini dalam daftar silabus (1 = paling atas).</p>
                @error('urutan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl font-bold">Simpan Modul</button>
        </form>
    </div>
</div>
@endsection
