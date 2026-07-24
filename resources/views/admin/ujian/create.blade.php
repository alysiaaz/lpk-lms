@extends('layouts.admin')
@section('title', 'Tambah Ujian - ' . $kursus->judul)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="text-xs font-bold text-lpk-teal hover:underline">&larr; Batal & Kembali</a>
        <h1 class="text-2xl font-black text-lpk-teal mt-1">Tambah Ujian Baru</h1>
        <p class="text-sm text-gray-500 font-medium">Untuk kursus: {{ $kursus->judul }}</p>
    </div>

    <!-- Form -->
    <div class="bg-white p-8 rounded-3xl border border-lpk-teal/10 shadow-sm">
        <form action="{{ route('admin.kursus.ujian.store', $kursus->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Judul Ujian -->
            <div>
                <label class="block text-sm font-bold text-lpk-charcoal mb-2">Judul Ujian <span class="text-red-500">*</span></label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Pre-test Evaluasi Awal Modul" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal text-sm font-medium" required>
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Tipe Ujian -->
                <div>
                    <label class="block text-sm font-bold text-lpk-charcoal mb-2">Tipe Ujian <span class="text-red-500">*</span></label>
                    <select name="tipe" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal text-sm font-semibold" required>
                        <option value="pre-test" {{ old('tipe') === 'pre-test' ? 'selected' : '' }}>📝 Pre-Test (Sebelum Materi)</option>
                        <option value="post-test" {{ old('tipe') === 'post-test' ? 'selected' : '' }}>🎓 Post-Test (Setelah 100% Materi)</option>
                    </select>
                    <p class="text-xs text-gray-400 mt-1.5 font-medium">Post-test otomatis terkunci untuk peserta yang belum 100% materi.</p>
                    @error('tipe') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Durasi Waktu -->
                <div>
                    <label class="block text-sm font-bold text-lpk-charcoal mb-2">Durasi Pengerjaan (Menit) <span class="text-red-500">*</span></label>
                    <input type="number" name="waktu_menit" value="{{ old('waktu_menit', 30) }}" min="1" class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal text-sm font-bold" required>
                    @error('waktu_menit') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-bold text-lpk-charcoal mb-2">Deskripsi atau Petunjuk Mengerjakan</label>
                <textarea name="deskripsi" rows="4" placeholder="Tuliskan petunjuk pengerjaan ujian untuk peserta di sini..." class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-lpk-teal focus:border-lpk-teal text-sm font-medium">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.kursus.ujian.index', $kursus->id) }}" class="px-6 py-3.5 rounded-full text-sm font-bold text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-admin-navy hover:bg-admin-navy-2 text-white font-extrabold text-sm px-8 py-3.5 rounded-full shadow transition">
                    Simpan Ujian
                </button>
            </div>
        </form>
    </div>

</div>
@endsection