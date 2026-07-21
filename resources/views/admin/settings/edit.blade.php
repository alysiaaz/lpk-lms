@extends('layouts.admin')
@section('content')
<div class="max-w-3xl space-y-6">
    <h2 class="text-2xl font-bold text-lpk-teal">Edit Halaman Tentang Kami</h2>

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        <!-- Sejarah -->
        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-lpk-teal mb-4">Sejarah / Profil Singkat Lembaga</h3>
            <textarea name="tentang_sejarah" rows="5" class="w-full border p-2 rounded" placeholder="Contoh: LPK Karier Sukses berdiri sejak tahun ... dengan tujuan ...">{{ old('tentang_sejarah', $settings['tentang_sejarah'] ?? '') }}</textarea>
            @error('tentang_sejarah') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Visi Misi -->
        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-lpk-teal mb-4">Visi & Misi</h3>
            <div class="mb-4">
                <label class="block font-bold mb-1">Visi</label>
                <textarea name="tentang_visi" rows="3" class="w-full border p-2 rounded">{{ old('tentang_visi', $settings['tentang_visi'] ?? '') }}</textarea>
                @error('tentang_visi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-bold mb-1">Misi</label>
                <textarea name="tentang_misi" rows="3" class="w-full border p-2 rounded">{{ old('tentang_misi', $settings['tentang_misi'] ?? '') }}</textarea>
                @error('tentang_misi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Keunggulan -->
        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-lpk-teal mb-2">Keunggulan Kami</h3>
            <p class="text-xs text-gray-500 mb-4">Tulis satu poin keunggulan per baris (tekan Enter untuk poin baru). Setiap baris akan otomatis tampil sebagai daftar terpisah di halaman publik.</p>
            <textarea name="tentang_keunggulan" rows="5" class="w-full border p-2 rounded" placeholder="Instruktur berpengalaman di bidangnya&#10;Jaminan penyaluran kerja bagi lulusan&#10;Sertifikat resmi setelah lulus&#10;Kelas kecil, belajar lebih fokus">{{ old('tentang_keunggulan', $settings['tentang_keunggulan'] ?? '') }}</textarea>
            @error('tentang_keunggulan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Kontak & Lokasi -->
        <div class="bg-white p-8 rounded-2xl shadow">
            <h3 class="text-lg font-bold text-lpk-teal mb-4">Kontak & Lokasi</h3>

            <div class="mb-4">
                <label class="block font-bold mb-1">Alamat</label>
                <textarea name="tentang_alamat" rows="2" class="w-full border p-2 rounded" placeholder="Jl. Contoh No. 123, Kota, Provinsi">{{ old('tentang_alamat', $settings['tentang_alamat'] ?? '') }}</textarea>
                @error('tentang_alamat') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-bold mb-1">Telepon / WhatsApp</label>
                    <input type="text" name="tentang_telepon" value="{{ old('tentang_telepon', $settings['tentang_telepon'] ?? '') }}" class="w-full border p-2 rounded" placeholder="0812xxxxxxx">
                    @error('tentang_telepon') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block font-bold mb-1">Email</label>
                    <input type="email" name="tentang_email" value="{{ old('tentang_email', $settings['tentang_email'] ?? '') }}" class="w-full border p-2 rounded" placeholder="info@lpkkariersukses.id">
                    @error('tentang_email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block font-bold mb-1">Jam Operasional</label>
                <input type="text" name="tentang_jam_operasional" value="{{ old('tentang_jam_operasional', $settings['tentang_jam_operasional'] ?? '') }}" class="w-full border p-2 rounded" placeholder="Senin - Jumat, 08.00 - 17.00 WIB">
                @error('tentang_jam_operasional') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <button class="bg-lpk-teal text-white px-8 py-3 rounded-xl font-bold">Simpan Semua Perubahan</button>
    </form>
</div>
@endsection
