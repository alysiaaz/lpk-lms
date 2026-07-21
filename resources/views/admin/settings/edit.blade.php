@extends('layouts.admin')
@section('content')
<div class="bg-white p-8 rounded-2xl shadow">
    <h2 class="text-2xl font-bold text-lpk-teal mb-6">Edit Tentang Kami</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block font-bold mb-1">Visi</label>
            <textarea name="tentang_visi" rows="4" class="w-full border p-2 rounded">{{ old('tentang_visi', $settings['tentang_visi'] ?? '') }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-1">Misi</label>
            <textarea name="tentang_misi" rows="4" class="w-full border p-2 rounded">{{ old('tentang_misi', $settings['tentang_misi'] ?? '') }}</textarea>
        </div>
        <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl">Simpan</button>
    </form>
</div>
@endsection