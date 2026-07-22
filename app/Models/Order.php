<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_order', 'peserta_id', 'kursus_id', 'voucher_id',
        'subtotal', 'diskon', 'total', 'status',
    ];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'peserta_id');
    }

    public function kursus()
    {
        return $this->belongsTo(Kursus::class, 'kursus_id');
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
