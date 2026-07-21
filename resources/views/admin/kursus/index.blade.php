@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-extrabold text-lpk-teal">Pusat Kontrol Kursus</h1>
        <a href="{{ route('admin.kursus.create') }}" class="bg-lpk-teal text-white px-6 py-3 rounded-xl font-bold hover:bg-lpk-gold transition">
            + Tambah Kursus Baru
        </a>
    </div>

    <!-- Tampilan yang lebih "Content Management" daripada sekadar tabel -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($kursuses as $kursus)
        <div class="bg-white p-6 rounded-3xl border border-lpk-teal/10 shadow-sm hover:shadow-md transition">
            <h2 class="text-xl font-bold text-lpk-charcoal mb-2">{{ $kursus->judul }}</h2>
            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $kursus->deskripsi }}</p>
            
            <div class="flex space-x-2">
                <!-- Tombol Inilah yang membuka halaman edit seluruh detail yang kamu mau -->
                <a href="{{ route('admin.kursus.edit', $kursus->id) }}" class="flex-1 text-center bg-gray-100 hover:bg-lpk-teal hover:text-white py-2 rounded-lg font-bold text-sm transition">
                    Edit Detail
                </a>
                <a href="{{ route('admin.kursus.modul.index', $kursus->id) }}" class="flex-1 text-center bg-gray-100 hover:bg-lpk-teal hover:text-white py-2 rounded-lg font-bold text-sm transition">
                    Edit Silabus
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection