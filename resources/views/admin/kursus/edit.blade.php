@extends('layouts.admin')
@section('title', 'Edit Kursus')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-3xl font-extrabold text-lpk-teal">Edit Kursus: {{ $kursus->judul }}</h1>

    <form action="{{ route('admin.kursus.update', $kursus->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-3xl shadow-sm border border-lpk-teal/10 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-bold text-lpk-charcoal mb-2">Judul Kursus</label>
            <input type="text" name="judul" value="{{ old('judul', $kursus->judul) }}" class="w-full border border-lpk-teal/20 p-3 rounded-xl" required>
        </div>

        <div>
            <label class="block font-bold text-lpk-charcoal mb-2">Kategori</label>
            <select name="kategori_id" class="w-full border border-lpk-teal/20 p-3 rounded-xl">
                <option value="">-- Pilih kategori yang sudah ada --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $kursus->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama }}
                    </option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-2">Atau ketik nama kategori baru (kosongkan pilihan di atas):</p>
            <input type="text" name="kategori_baru" class="w-full border border-lpk-teal/20 p-3 rounded-xl mt-1" placeholder="Nama kategori baru">
        </div>

        <div>
            <label class="block font-bold text-lpk-charcoal mb-2">Deskripsi / Penjelasan Utama</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-lpk-teal/20 p-3 rounded-xl" required>{{ old('deskripsi', $kursus->deskripsi) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-bold text-lpk-charcoal mb-2">Status Kelas</label>
                <input type="text" name="status_kelas" value="{{ old('status_kelas', $kursus->status_kelas) }}" class="w-full border border-lpk-teal/20 p-3 rounded-xl" required>
            </div>
            <div>
                <label class="block font-bold text-lpk-charcoal mb-2">Metode Belajar</label>
                <input type="text" name="metode_belajar" value="{{ old('metode_belajar', $kursus->metode_belajar) }}" class="w-full border border-lpk-teal/20 p-3 rounded-xl">
            </div>
            <div>
                <label class="block font-bold text-lpk-charcoal mb-2">Tingkat Kesiapan</label>
                <input type="text" name="tingkat_kesiapan" value="{{ old('tingkat_kesiapan', $kursus->tingkat_kesiapan) }}" class="w-full border border-lpk-teal/20 p-3 rounded-xl">
            </div>
            <div>
                <label class="block font-bold text-lpk-charcoal mb-2">Sertifikat</label>
                <input type="text" name="sertifikat" value="{{ old('sertifikat', $kursus->sertifikat) }}" class="w-full border border-lpk-teal/20 p-3 rounded-xl">
            </div>
        </div>

        <div>
            <label class="block font-bold text-lpk-charcoal mb-2">Thumbnail</label>
            @if($kursus->thumbnail)
                <img src="{{ asset('storage/'.$kursus->thumbnail) }}" class="w-32 h-20 object-cover rounded mb-2">
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full border border-lpk-teal/20 p-3 rounded-xl">
            <p class="text-xs text-gray-500 mt-1">Kosongkan kalau tidak mau ganti gambar.</p>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_unggulan" id="is_unggulan" value="1" @checked(old('is_unggulan', $kursus->is_unggulan))>
            <label for="is_unggulan" class="font-bold text-lpk-charcoal">Tampilkan sebagai Unggulan di Beranda</label>
        </div>

        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('admin.kursus.index') }}" class="px-6 py-3 rounded-xl border border-gray-300 font-bold text-gray-600">Batal</a>
            <button type="submit" class="bg-lpk-teal text-white px-8 py-3 rounded-xl font-bold hover:bg-lpk-gold transition">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection