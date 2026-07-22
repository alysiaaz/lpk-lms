@extends('layouts.admin')
@section('title', 'Edit Kursus')
@section('page-title', 'Edit Kursus')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-2xl font-bold text-admin-text">Edit Kursus: {{ $kursus->judul }}</h1>

    <form action="{{ route('admin.kursus.update', $kursus->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl border border-admin-border shadow-sm space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Judul Kursus</label>
            <input type="text" name="judul" value="{{ old('judul', $kursus->judul) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Kategori</label>
            <select name="kategori_id" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                <option value="">-- Pilih kategori yang sudah ada --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kursus->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-admin-muted mt-2">Atau ketik nama kategori baru (kosongkan pilihan di atas):</p>
            <input type="text" name="kategori_baru" class="w-full border border-admin-border p-2.5 rounded-lg mt-1 focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" placeholder="Nama kategori baru">
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Deskripsi / Penjelasan Utama</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Harga (Rp)</label>
            <input type="number" name="harga" min="0" step="1000" value="{{ old('harga', $kursus->harga) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            <p class="text-xs text-admin-muted mt-1">Isi 0 jika kursus ini gratis.</p>
            @error('harga') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Status Kelas</label>
                <input type="text" name="status_kelas" value="{{ old('status_kelas', $kursus->status_kelas) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Metode Belajar</label>
                <input type="text" name="metode_belajar" value="{{ old('metode_belajar', $kursus->metode_belajar) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Tingkat Kesiapan</label>
                <input type="text" name="tingkat_kesiapan" value="{{ old('tingkat_kesiapan', $kursus->tingkat_kesiapan) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Sertifikat</label>
                <input type="text" name="sertifikat" value="{{ old('sertifikat', $kursus->sertifikat) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Thumbnail</label>
            @if($kursus->thumbnail)
                <img src="{{ asset('storage/'.$kursus->thumbnail) }}" class="w-32 h-20 object-cover rounded-lg mb-2 border border-admin-border">
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full border border-admin-border p-2.5 rounded-lg text-sm">
            <p class="text-xs text-admin-muted mt-1">Kosongkan kalau tidak mau ganti gambar.</p>
        </div>

        <div class="flex items-center gap-2 bg-admin-bg p-3 rounded-lg">
            <input type="checkbox" name="is_unggulan" id="is_unggulan" value="1" @checked(old('is_unggulan', $kursus->is_unggulan)) class="w-4 h-4 accent-admin-accent">
            <label for="is_unggulan" class="text-sm font-semibold text-admin-text">Tampilkan sebagai Unggulan di Beranda</label>
        </div>

        <div class="flex justify-end space-x-3 pt-2 border-t border-admin-border">
            <a href="{{ route('admin.kursus.index') }}" class="px-6 py-2.5 rounded-lg border border-admin-border font-semibold text-sm text-admin-muted hover:bg-admin-bg transition">Batal</a>
            <button type="submit" class="bg-admin-accent text-white px-8 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection