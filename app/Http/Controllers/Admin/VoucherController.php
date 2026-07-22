<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::latest()->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        $voucher = null;
        return view('admin.vouchers.create', compact('voucher'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|unique:vouchers,kode|max:50',
            'tipe' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:1',
            'kuota' => 'nullable|integer|min:1',
            'min_pembelian' => 'nullable|integer|min:0',
            'berlaku_sampai' => 'nullable|date',
            'aktif' => 'boolean',
        ]);

        $validated['kode'] = strtoupper($validated['kode']);
        $validated['aktif'] = $request->boolean('aktif');

        Voucher::create($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat.');
    }

    public function edit(Voucher $voucher)
    {
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:vouchers,kode,' . $voucher->id,
            'tipe' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:1',
            'kuota' => 'nullable|integer|min:1',
            'min_pembelian' => 'nullable|integer|min:0',
            'berlaku_sampai' => 'nullable|date',
            'aktif' => 'boolean',
        ]);

        $validated['kode'] = strtoupper($validated['kode']);
        $validated['aktif'] = $request->boolean('aktif');

        $voucher->update($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil diperbarui.');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus.');
    }
}