<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypeCustomer extends Model
{
    use HasFactory;

    protected $table = 'tipe_pembayaran_pembeli';

    protected $fillable = [
        'id_pembeli',
        'id_pembayaran',
        'plafon_kredit',
        'sisa_plafon'
    ];

    public function tipe_pembayaran()
    {
        return $this->belongsTo(PaymentType::class, 'id_pembayaran');
    }

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }
}
