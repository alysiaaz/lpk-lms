@extends('layouts.admin')
@section('title', 'Kelola Kursus')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-extrabold text-lpk-teal">Daftar Kursus</h1>
        <a href="{{ route('admin.kursus.create') }}" class="bg-lpk-teal text-white px-6 py-3 rounded-xl font-bold hover:bg-lpk-gold transition shadow-lg">
            + Tambah Kursus Baru
        </a>
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-3xl shadow-sm border border-lpk-teal/10 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-lpk-bg text-lpk-teal uppercase text-xs font-bold">
                <tr>
                    <th class="px-6 py-4">Nama Kursus</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-lpk-bg">
                @foreach($kursuses as $kursus)
                <tr class="hover:bg-lpk-bg/50 transition">
                    <td class="px-6 py-4 font-semibold text-lpk-charcoal">{{ $kursus->nama_kursus }}</td>
                    <td class="px-6 py-4">{{ $kursus->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Aktif</span>
                    </td>
                    <td class="px-6 py-4 text-center space-x-3">
                        <!-- Tombol Kelola Modul -->
                        <a href="{{ route('admin.modul.index', $kursus->id) }}" class="text-lpk-teal font-bold hover:underline">
                            Kelola Modul
                        </a>
                        <a href="{{ route('admin.kursus.edit', $kursus->id) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection