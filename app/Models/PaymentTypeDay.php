<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypeDay extends Model
{
    use HasFactory;

    protected $table = 'tipe_pembayaran_hari';

    protected $fillable = [
        'id_tipe_pembayaran',
        'id_pembeli',
        'hari',
        'rate'
    ];

    public function tipe_pembayaran()
    {
        return $this->belongsTo(PaymentType::class, 'id_tipe_pembayaran');
    }

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }
}
