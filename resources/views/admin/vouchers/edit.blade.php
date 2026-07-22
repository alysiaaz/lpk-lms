@extends('layouts.admin')
@section('page-title', 'Edit Voucher')

@section('content')
<div class="space-y-6">
    <div>
        <a href="{{ route('admin.vouchers.index') }}" class="text-sm text-admin-accent font-medium hover:underline">&larr; Kembali ke Voucher</a>
        <h1 class="text-2xl font-bold text-admin-text mt-1">Edit Voucher: {{ $voucher->kode }}</h1>
    </div>

    <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        @include('admin.vouchers._form')

        <div class="flex justify-end">
            <button type="submit" class="bg-admin-accent text-white px-6 py-2.5 rounded-lg font-semibold text-sm hover:bg-admin-accent-dark transition shadow-sm">
                Update Voucher
            </button>
        </div>
    </form>
</div>
@endsection