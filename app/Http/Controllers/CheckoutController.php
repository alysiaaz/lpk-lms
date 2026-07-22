<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function show(Kursus $kursus)
    {
        [$voucher, $diskon] = $this->hitungVoucher($kursus);
        $total = $kursus->harga - $diskon;

        return view('checkout.show', compact('kursus', 'voucher', 'diskon', 'total'));
    }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'kursus_id' => 'required|exists:kursuses,id',
        ]);

        $kursus = Kursus::findOrFail($request->kursus_id);
        $voucher = Voucher::where('kode', strtoupper($request->kode))->first();

        if (!$voucher || !$voucher->isValidFor($kursus->harga)) {
            return back()->with('voucher_error', 'Kode voucher tidak valid, sudah kadaluarsa, atau tidak memenuhi syarat.');
        }

        session(['voucher_kode' => $voucher->kode]);

        return back()->with('success', 'Voucher berhasil digunakan.');
    }

    public function removeVoucher()
    {
        session()->forget('voucher_kode');
        return back();
    }

    public function store(Request $request, Kursus $kursus)
    {
        [$voucher, $diskon] = $this->hitungVoucher($kursus);
        $total = $kursus->harga - $diskon;

        $order = Order::create([
            'kode_order' => 'ORD-' . strtoupper(Str::random(8)),
            'peserta_id' => auth()->id(),
            'kursus_id' => $kursus->id,
            'voucher_id' => $voucher?->id,
            'subtotal' => $kursus->harga,
            'diskon' => $diskon,
            'total' => $total,
            'status' => 'pending',
        ]);

        if ($voucher) {
            $voucher->increment('terpakai');
        }

        session()->forget('voucher_kode');

        return redirect()->route('payment.show', $order);
    }

    private function hitungVoucher(Kursus $kursus): array
    {
        if (!session('voucher_kode')) {
            return [null, 0];
        }

        $voucher = Voucher::where('kode', session('voucher_kode'))->first();

        if (!$voucher || !$voucher->isValidFor($kursus->harga)) {
            session()->forget('voucher_kode');
            return [null, 0];
        }

        return [$voucher, $voucher->hitungDiskon($kursus->harga)];
    }
}