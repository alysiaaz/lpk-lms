@extends('layouts.admin')
@section('page-title', 'Tambah Materi')

@section('content')
<div class="max-w-xl space-y-4">
    <a href="{{ route('admin.kursus.modul.materi.index', [$kursus->id, $modul->id]) }}" class="text-sm text-admin-accent font-medium hover:underline">&larr; Kembali ke Daftar Materi</a>

    <div class="bg-white p-8 rounded-2xl border border-admin-border shadow-sm">
        <h2 class="text-xl font-bold text-admin-text mb-1">Tambah Materi Baru</h2>
        <p class="text-sm text-admin-muted mb-6">Untuk modul: <span class="font-semibold text-admin-text">{{ $modul->judul_modul }}</span> ({{ $kursus->judul }})</p>

        <form action="{{ route('admin.kursus.modul.materi.store', [$kursus->id, $modul->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Judul Materi</label>
                <input type="text" name="judul_materi" value="{{ old('judul_materi') }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" placeholder="Contoh: Pengenalan Tag HTML Dasar">
                @error('judul_materi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Tipe Materi</label>
                <select name="tipe" id="tipe" onchange="toggleTipe()" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                    <option value="pdf" {{ old('tipe') === 'pdf' ? 'selected' : '' }}>PDF (Dokumen)</option>
                    <option value="video" {{ old('tipe') === 'video' ? 'selected' : '' }}>Video</option>
                </select>
                @error('tipe') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="blok-pdf">
                <label class="block text-sm font-semibold text-admin-text mb-1.5">File PDF</label>
                <input type="file" name="file_pdf" accept="application/pdf" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                <p class="text-xs text-admin-muted mt-1">Maksimal 50MB, format .pdf</p>
                @error('file_pdf') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div id="blok-video" class="hidden space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-admin-text mb-1.5">Sumber Video</label>
                    <select name="sumber_video" id="sumber_video" onchange="toggleSumberVideo()" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                        <option value="upload" {{ old('sumber_video') === 'upload' ? 'selected' : '' }}>Upload File Video</option>
                        <option value="link" {{ old('sumber_video', 'link') === 'link' ? 'selected' : '' }}>Link YouTube/Vimeo</option>
                    </select>
                </div>

                <div id="blok-video-upload">
                    <label class="block text-sm font-semibold text-admin-text mb-1.5">File Video</label>
                    <input type="file" name="file_video" accept="video/*" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                    <p class="text-xs text-admin-muted mt-1">Maksimal 50MB, format .mp4/.mov/.avi/.webm</p>
                    @error('file_video') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div id="blok-video-link" class="hidden">
                    <label class="block text-sm font-semibold text-admin-text mb-1.5">Link Video</label>
                    <input type="url" name="url_video" value="{{ old('url_video') }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none" placeholder="https://youtube.com/watch?v=...">
                    @error('url_video') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-admin-text mb-1.5">Urutan</label>
                <input type="number" name="urutan" min="1" value="{{ old('urutan', $urutanBerikutnya) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
                <p class="text-xs text-admin-muted mt-1">Menentukan posisi materi ini dalam daftar (1 = paling atas).</p>
                @error('urutan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button class="bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition">Simpan Materi</button>
        </form>
    </div>
</div>

<script>
    function toggleTipe() {
        const tipe = document.getElementById('tipe').value;
        document.getElementById('blok-pdf').classList.toggle('hidden', tipe !== 'pdf');
        document.getElementById('blok-video').classList.toggle('hidden', tipe !== 'video');
        if (tipe === 'video') toggleSumberVideo();
    }
    function toggleSumberVideo() {
        const sumber = document.getElementById('sumber_video').value;
        document.getElementById('blok-video-upload').classList.toggle('hidden', sumber !== 'upload');
        document.getElementById('blok-video-link').classList.toggle('hidden', sumber !== 'link');
    }
    document.addEventListener('DOMContentLoaded', toggleTipe);
</script>
@endsection
