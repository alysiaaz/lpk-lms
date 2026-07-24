@extends('layouts.admin')
@section('title', 'Tambah Soal - ' . $ujian->judul)
@section('page-title', 'Tambah Soal Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <a href="{{ route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id]) }}" class="text-xs font-bold text-admin-navy hover:underline">&larr; Batal & Kembali</a>
        <h1 class="text-2xl font-black text-admin-navy mt-1">Buat Pertanyaan Baru</h1>
        <p class="text-sm text-gray-500 font-medium">Untuk Ujian: {{ $ujian->judul }}</p>
    </div>

    <div class="bg-white p-8 rounded-3xl border border-gray-200 shadow-sm">
        <form action="{{ route('admin.kursus.ujian.soal.store', [$kursus->id, $ujian->id]) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Pertanyaan -->
            <div>
                <label class="block text-sm font-bold text-admin-navy mb-2">Teks Pertanyaan <span class="text-red-500">*</span></label>
                <textarea name="pertanyaan" rows="3" placeholder="Tuliskan pertanyaan ujian di sini..." class="w-full px-4 py-3 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-admin-navy focus:border-admin-navy text-sm font-medium" required>{{ old('pertanyaan') }}</textarea>
                @error('pertanyaan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <hr class="border-gray-100">

            <!-- 4 Opsi Pilihan Ganda -->
            <div class="space-y-4">
                <label class="block text-sm font-bold text-admin-navy">Pilihan Ganda & Kunci Jawaban <span class="text-red-500">*</span></label>
                <p class="text-xs text-gray-400 -mt-3 mb-2">Pilih salah satu radio button di sebelah kiri sebagai penanda kunci jawaban yang benar.</p>

                @foreach(['A', 'B', 'C', 'D'] as $index => $label)
                    <div class="flex items-center gap-3 p-2 rounded-2xl border border-gray-200 focus-within:border-admin-navy focus-within:ring-1 focus-within:ring-admin-navy">
                        <div class="pl-3 flex items-center gap-2">
                            <!-- Radio button untuk menandai mana opsi yang benar (indeks 0, 1, 2, atau 3) -->
                            <input type="radio" name="jawaban_benar" value="{{ $index }}" class="w-4 h-4 text-admin-navy focus:ring-admin-navy cursor-pointer" {{ $index === 0 ? 'checked' : '' }} required title="Jadikan kunci jawaban">
                            <span class="font-black text-sm text-gray-400">{{ $label }}</span>
                        </div>
                        <input type="text" name="opsi[]" placeholder="Tulis pilihan jawaban {{ $label }}..." class="w-full border-0 focus:ring-0 text-sm font-medium py-2 px-2" required>
                    </div>
                @endforeach
                @error('jawaban_benar') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                <a href="{{ route('admin.kursus.ujian.soal.index', [$kursus->id, $ujian->id]) }}" class="px-6 py-3.5 rounded-full text-sm font-bold text-gray-500 hover:bg-gray-100 transition">
                    Batal
                </a>
                <button type="submit" class="bg-admin-navy hover:bg-admin-navy-2 text-white font-extrabold text-sm px-8 py-3.5 rounded-full shadow transition">
                    Simpan Soal & Pilihan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection