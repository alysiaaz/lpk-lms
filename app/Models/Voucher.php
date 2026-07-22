<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'tipe', 'nilai', 'kuota', 'terpakai',
        'min_pembelian', 'berlaku_sampai', 'aktif',
    ];

    protected $casts = [
        'berlaku_sampai' => 'date',
        'aktif' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function isValidFor(int $subtotal): bool
    {
        if (!$this->aktif) return false;
        if ($this->berlaku_sampai && now()->gt($this->berlaku_sampai)) return false;
        if ($this->kuota !== null && $this->terpakai >= $this->kuota) return false;
        if ($subtotal < $this->min_pembelian) return false;

        return true;
    }

    public function hitungDiskon(int $subtotal): int
    {
        return $this->tipe === 'persen'
            ? (int) round($subtotal * $this->nilai / 100)
            : min($this->nilai, $subtotal);
    }
}
