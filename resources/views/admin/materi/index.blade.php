@extends('layouts.admin')
@section('page-title', 'Materi Modul')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <a href="{{ route('admin.kursus.modul.index', $kursus->id) }}" class="text-sm text-admin-accent font-medium hover:underline">&larr; Kembali ke Silabus</a>
            <h1 class="text-2xl font-bold text-admin-text mt-1">Materi: {{ $modul->judul_modul }}</h1>
            <p class="text-sm text-admin-muted">Kursus: {{ $kursus->judul }}</p>
        </div>
        <a href="{{ route('admin.kursus.modul.materi.create', [$kursus->id, $modul->id]) }}" class="inline-flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Materi
        </a>
    </div>

    @if(session('success'))
        <div class="p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-sm font-medium">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-2xl border border-admin-border shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-admin-bg text-admin-muted uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-3.5">Urutan</th>
                    <th class="px-6 py-3.5">Judul Materi</th>
                    <th class="px-6 py-3.5">Tipe</th>
                    <th class="px-6 py-3.5">Konten</th>
                    <th class="px-6 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-admin-border">
                @forelse($materis as $materi)
                <tr class="hover:bg-admin-bg/60 transition">
                    <td class="px-6 py-4 text-sm text-admin-muted">{{ $materi->urutan }}</td>
                    <td class="px-6 py-4 font-semibold text-admin-text text-sm">{{ $materi->judul_materi }}</td>
                    <td class="px-6 py-4 text-sm">
                        <span class="inline-block px-2.5 py-1 rounded-full text-xs font-bold uppercase
                            {{ $materi->tipe === 'pdf' ? 'bg-sky-50 text-sky-700' : 'bg-amber-50 text-amber-700' }}">
                            {{ $materi->tipe }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @if($materi->file_path)
                            <a href="{{ $materi->fileUrl() }}" target="_blank" class="text-admin-accent hover:underline font-medium">File terupload</a>
                        @elseif($materi->url_video)
                            <a href="{{ $materi->url_video }}" target="_blank" class="text-admin-accent hover:underline font-medium">Link eksternal</a>
                        @else
                            <span class="text-admin-muted">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.kursus.modul.materi.edit', [$kursus->id, $modul->id, $materi->id]) }}" class="text-admin-accent font-semibold hover:underline text-sm">
                            Edit
                        </a>
                        <form action="{{ route('admin.kursus.modul.materi.destroy', [$kursus->id, $modul->id, $materi->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus materi {{ $materi->judul_materi }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold hover:underline text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-admin-muted text-sm">Belum ada materi untuk modul ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
