@extends('layouts.admin')
@section('content')
<div class="bg-white p-8 rounded-2xl shadow max-w-2xl">
    <h2 class="text-2xl font-bold text-lpk-teal mb-6">Tambah Kursus Baru</h2>

    <form action="{{ route('admin.kursus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-1">Judul Kursus</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border p-2 rounded">
            @error('judul') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Kategori</label>
            <select name="kategori_id" class="w-full border p-2 rounded">
                <option value="">-- Pilih kategori yang sudah ada --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-2">Atau ketik nama kategori baru (kosongkan pilihan di atas):</p>
            <input type="text" name="kategori_baru" value="{{ old('kategori_baru') }}" placeholder="Nama kategori baru" class="w-full border p-2 rounded mt-1">
            @error('kategori_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border p-2 rounded">{{ old('deskripsi') }}</textarea>
            @error('deskripsi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-bold mb-1">Status Kelas</label>
                <input type="text" name="status_kelas" value="{{ old('status_kelas', 'Pendaftaran Buka') }}" class="w-full border p-2 rounded">
                @error('status_kelas') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-bold mb-1">Metode Belajar</label>
                <input type="text" name="metode_belajar" value="{{ old('metode_belajar') }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-bold mb-1">Tingkat Kesiapan</label>
                <input type="text" name="tingkat_kesiapan" value="{{ old('tingkat_kesiapan') }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-bold mb-1">Sertifikat</label>
                <input type="text" name="sertifikat" value="{{ old('sertifikat') }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full border p-2 rounded">
            @error('thumbnail') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6 flex items-center gap-2">
            <input type="checkbox" name="is_unggulan" id="is_unggulan" value="1" @checked(old('is_unggulan'))>
            <label for="is_unggulan" class="font-bold">Tampilkan sebagai Unggulan di Beranda</label>
        </div>

        <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl font-bold">Simpan</button>
    </form>
</div>
@endsection