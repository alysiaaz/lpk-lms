@extends('layouts.admin')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="bg-white p-8 rounded-2xl border border-admin-border shadow-sm max-w-lg">
    <h2 class="text-xl font-bold text-admin-text mb-6">Edit Kategori</h2>

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-admin-text mb-1.5">Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="w-full border border-admin-border p-2.5 rounded-lg focus:ring-2 focus:ring-admin-accent focus:border-admin-accent outline-none">
            @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <button class="bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition">Simpan Perubahan</button>
    </form>
</div>
@endsection
