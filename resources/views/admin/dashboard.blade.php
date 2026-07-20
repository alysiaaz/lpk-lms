@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="py-12 bg-lpk-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- Header -->
        <div class="bg-lpk-teal text-white p-10 rounded-[2.5rem] shadow-xl mb-8">
            <h1 class="text-3xl font-extrabold">Halo, Admin!</h1>
            <p class="text-lpk-bg/70 mt-2">Berikut adalah ringkasan data saat ini.</p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-sm font-bold text-gray-500">Total Kursus</h2>
                <p class="text-4xl font-extrabold text-lpk-teal mt-2">{{ $totalKursus }}</p>
            </div>
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-sm font-bold text-gray-500">Total Peserta</h2>
                <p class="text-4xl font-extrabold text-lpk-teal mt-2">{{ $totalPeserta }}</p>
            </div>
            <div class="bg-white p-8 rounded-3xl border shadow-sm">
                <h2 class="text-sm font-bold text-gray-500">Total Kategori</h2>
                <p class="text-4xl font-extrabold text-lpk-teal mt-2">{{ $totalKategori }}</p>
            </div>
        </div>

        <!-- Daftar Kursus Terbaru -->
        <div class="bg-white p-8 rounded-3xl border shadow-sm">
            <h2 class="text-xl font-bold text-lpk-teal mb-4">Kursus Terbaru</h2>
            <ul>
                @foreach($kursusTerbaru as $kursus)
                    <li class="py-3 border-b text-sm font-medium">{{ $kursus->nama_kursus }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection