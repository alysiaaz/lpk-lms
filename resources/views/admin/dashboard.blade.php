@extends('layouts.admin')
@section('content')
<h1 class="text-3xl font-bold text-lpk-teal mb-6">Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Kursus</p>
        <h3 class="text-3xl font-bold">{{ $totalKursus }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Peserta</p>
        <h3 class="text-3xl font-bold">{{ $totalPeserta }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow">
        <p class="text-gray-500">Total Kategori</p>
        <h3 class="text-3xl font-bold">{{ $totalKategori }}</h3>
    </div>
</div>
@endsection