@extends('layouts.admin')
@section('content')
<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">
    <h2 class="text-2xl font-bold text-lpk-teal mb-6">Tambah Kursus Baru</h2>

    <form action="{{ route('admin.kursus.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-1">Judul Kursus</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border p-2 rounded">
            @error('judul') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block font-bold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border p-2 rounded">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl font-bold">Simpan</button>
    </form>
</div>
@endsection