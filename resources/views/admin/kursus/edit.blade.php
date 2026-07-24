@extends('layouts.admin')
@section('page-title', 'Edit Kursus')

@section('content')
<div class="bg-white p-8 rounded-2xl border border-admin-border shadow-sm max-w-2xl">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold text-admin-text mb-1">Edit Kursus: {{ $kursus->judul }}</h2>
            <p class="text-sm text-admin-muted">Perbarui informasi dan spesifikasi kursus ini.</p>
        </div>
        <a href="{{ route('admin.kursus.index') }}" class="text-xs font-bold text-admin-accent hover:underline">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.kursus.update', $kursus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Judul Kursus</label>
            <input type="text" name="judul" value="{{ old('judul', $kursus->judul) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" required>
            @error('judul') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Kategori</label>
            <select name="kategori_id" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('kategori_id', $kursus->kategori_id) == $kategori->id)>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-admin-muted mt-2">Atau ketik nama kategori baru (kosongkan pilihan di atas):</p>
            <input type="text" name="kategori_baru" value="{{ old('kategori_baru') }}" placeholder="Nama kategori baru" class="w-full border border-admin-border p-2.5 rounded-lg mt-1 focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            @error('kategori_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
            @error('deskripsi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Harga (Rp)</label>
            <input type="number" name="harga" min="0" step="1000" value="{{ old('harga', $kursus->harga) }}" placeholder="0" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            <p class="text-xs text-admin-muted mt-1">Isi 0 jika kursus ini gratis.</p>
            @error('harga') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Spesifikasi Kursus (Dropdown Pilihan) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-admin-bg p-4 rounded-xl border border-admin-border">
            <!-- Status Kelas -->
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Status Kelas</label>
                <select name="status_kelas" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none text-sm bg-white">
                    @foreach(['Pendaftaran Buka', 'Pendaftaran Tutup', 'Kelas Penuh', 'Sedang Berlangsung'] as $status)
                        <option value="{{ $status }}" @selected(old('status_kelas', $kursus->status_kelas) == $status)>{{ $status }}</option>
                    @endforeach
                </select>
                @error('status_kelas') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Metode Belajar -->
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Metode Belajar</label>
                <select name="metode_belajar" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none text-sm bg-white">
                    @foreach(['Mandiri (Self-Paced / Kapan Saja)', 'Webinar Live (Online)', 'Tatap Muka (Offline di Kelas)', 'Hybrid (Online & Offline)'] as $metode)
                        <option value="{{ $metode }}" @selected(old('metode_belajar', $kursus->metode_belajar) == $metode)>{{ $metode }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tingkat Kesiapan -->
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Tingkat Kesiapan</label>
                <select name="tingkat_kesiapan" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none text-sm bg-white">
                    @foreach(['Pemula (Beginner)', 'Menengah (Intermediate)', 'Mahir (Advanced)', 'Semua Tingkat (All Levels)'] as $tingkat)
                        <option value="{{ $tingkat }}" @selected(old('tingkat_kesiapan', $kursus->tingkat_kesiapan) == $tingkat)>{{ $tingkat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sertifikat -->
            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Sertifikat</label>
                <select name="sertifikat" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none text-sm bg-white">
                    @foreach(['Sertifikat Penyelesaian (Completion)', 'Sertifikat Kompetensi + Nilai', 'Tidak Ada Sertifikat'] as $sertifikat)
                        <option value="{{ $sertifikat }}" @selected(old('sertifikat', $kursus->sertifikat) == $sertifikat)>{{ $sertifikat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Thumbnail Saat Ini</label>
            @if($kursus->thumbnail)
                <img src="{{ asset('storage/' . $kursus->thumbnail) }}" alt="Thumbnail" class="w-32 h-20 object-cover rounded-lg mb-2 border">
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full border border-admin-border p-2.5 rounded-lg text-sm">
            <p class="text-xs text-admin-muted mt-1">Kosongkan jika tidak ingin mengubah thumbnail.</p>
            @error('thumbnail') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-2 bg-admin-bg p-3 rounded-lg">
            <input type="checkbox" name="is_unggulan" id="is_unggulan" value="1" @checked(old('is_unggulan', $kursus->is_unggulan) == 1) class="w-4 h-4 accent-admin-accent">
            <label for="is_unggulan" class="text-sm font-semibold text-admin-text">Tampilkan sebagai Unggulan di Beranda</label>
        </div>

        <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('admin.kursus.index') }}" class="px-5 py-2.5 rounded-lg font-semibold text-sm bg-gray-100 hover:bg-gray-200 text-admin-text transition">Batal</a>
            <button type="submit" class="bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection