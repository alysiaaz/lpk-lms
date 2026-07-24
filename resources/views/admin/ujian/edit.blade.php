@extends('layouts.admin')
@section('title', 'Edit Ujian - ' . $ujian->judul)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="text-xs font-bold text-admin-accent hover:underline">&larr; Batal & Kembali</a>
        <h1 class="text-2xl font-black text-admin-navy mt-1">Edit Data Ujian</h1>
        <p class="text-sm text-gray-500 font-medium">Untuk kursus: {{ $kursus->judul }}</p>
    </div>

    <!-- Form -->
    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <form action="{{ route('admin.kursus.ujian.update', [$kursus->id, $ujian->id]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul Ujian -->
            <div>
                <label class="block text-sm font-bold text-admin-navy mb-2">Judul Ujian <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul', $ujian->judul) }}" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-admin-navy focus:border-admin-navy text-sm font-medium" required>
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Tipe Ujian -->
                <div>
                    <label class="block text-sm font-bold text-admin-navy mb-2">Tipe Ujian <span class="text-red-500">*</span></label>
                    <select name="tipe" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-admin-navy focus:border-admin-navy text-sm font-semibold" required>
                        <option value="pre-test" {{ old('tipe', $ujian->tipe) === 'pre-test' ? 'selected' : '' }}>📝 Pre-Test (Tahap Awal)</option>
                        <option value="post-test" {{ old('tipe', $ujian->tipe) === 'post-test' ? 'selected' : '' }}>🎓 Post-Test (Tahap Akhir)</option>
                    </select>
                    @error('tipe') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Durasi Waktu -->
                <div>
                    <label class="block text-sm font-bold text-admin-navy mb-2">Durasi Pengerjaan (Menit) <span class="text-red-500">*</span></label>
                    <input type="number" name="waktu_menit" value="{{ old('waktu_menit', $ujian->waktu_menit) }}" min="1" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-admin-navy focus:border-admin-navy text-sm font-bold" required>
                    @error('waktu_menit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-bold text-admin-navy mb-2">Deskripsi atau Petunjuk Mengerjakan</label>
                <textarea name="deskripsi" rows="4" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-admin-navy focus:border-admin-navy text-sm font-medium">{{ old('deskripsi', $ujian->deskripsi) }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="px-6 py-3.5 rounded-full text-sm font-bold text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-admin-navy hover:bg-admin-navy-2 text-white font-extrabold text-sm px-8 py-3.5 rounded-full shadow transition">
                    Perbarui Ujian
                </button>
            </div>
        </form>
    </div>

</div>
@endsection