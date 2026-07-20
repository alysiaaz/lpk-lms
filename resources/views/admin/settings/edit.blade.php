@extends('layouts.admin')
@section('content')
<div class="bg-white p-8 rounded-2xl shadow">
    <h2 class="text-2xl font-bold text-lpk-teal mb-6">Edit Tentang Kami</h2>
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block font-bold">Visi</label>
            <textarea name="visi" class="w-full border p-2 rounded">{{ $settings->visi }}</textarea>
        </div>
        <button class="bg-lpk-teal text-white px-6 py-2 rounded-xl">Simpan</button>
    </form>
</div>
@endsection