@extends('layouts.admin')
@section('content')
<div class="bg-white p-8 rounded-2xl shadow max-w-lg">
    <h2 class="text-2xl font-bold text-lpk-teal mb-6">Tambah Kategori Baru</h2>

    <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label class="block font-bold mb-1">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border p-2 rounded" placeholder="Misal: Desain Grafis">
            @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl font-bold">Simpan</button>
    </form>
</div>
@endsection