<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa lihat halaman pembayarannya
        abort_unless($order->peserta_id === auth()->id(), 403);

        if ($order->status === 'lunas') {
            return redirect()->route('peserta.kursus')->with('info', 'Order ini sudah dibayar.');
        }

        return view('payment.show', compact('order'));
    }

    public function confirm(Order $order)
    {
        abort_unless($order->peserta_id === auth()->id(), 403);

        if ($order->status !== 'lunas') {
            $order->update(['status' => 'lunas']);

            $order->payment()->create([
                'metode' => 'qris_dummy',
                'transaction_id' => 'DUMMY-' . strtoupper(uniqid()),
                'status' => 'settlement',
                'raw_response' => ['catatan' => 'Simulasi pembayaran manual, belum terhubung payment gateway asli.'],
            ]);

            $user = auth()->user();

            if (!$user->kursuses()->where('kursus_id', $order->kursus_id)->exists()) {
                $user->kursuses()->attach($order->kursus_id, ['status' => 'aktif']);
            }
        }

        return redirect()->route('peserta.kursus')
            ->with('success', 'Pembayaran berhasil! Kamu sudah terdaftar di kursus "' . $order->kursus->judul . '".');
    }
}