<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reject extends Model
{
    use HasFactory;

    protected $table = 'distributor_ditolak_p2p';

    protected $fillable = [
        'id_pembeli', 'id_pembayaran', 'keterangan', 'tanggal'
    ];

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }

    public function tipe_pembayaran()
    {
        return $this->belongsTo(PaymentType::class, 'id_pembayaran');
    }
}
