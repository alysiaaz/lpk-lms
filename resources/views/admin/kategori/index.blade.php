@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-extrabold text-lpk-teal">Manajemen Kategori</h2>
        <a href="#" class="bg-lpk-teal text-white px-6 py-2 rounded-xl hover:bg-lpk-gold transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-sm border border-lpk-teal/10">
        <table class="w-full text-left">
            <thead>
                <tr class="text-lpk-teal uppercase text-xs font-bold">
                    <th class="p-4">No</th>
                    <th class="p-4">Nama Kategori</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <!-- Data akan muncul di sini nanti -->
                <tr>
                    <td class="p-4">1</td>
                    <td class="p-4">Programming</td>
                    <td class="p-4 text-lpk-teal font-bold hover:underline">Edit</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection