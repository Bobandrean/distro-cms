<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $table = 'tipe_pembayaran';

    protected $fillable = [
        'logo', 'nama', 'keterangan'
    ];

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function tipe_pembayaran_hari()
    {
        return $this->hasMany(PaymentTypeDay::class);
    }

    public function tipe_pembayaran_metode()
    {
        return $this->hasMany(PaymentTypeMethod::class);
    }

    public function tipe_pembayaran_pembeli()
    {
        return $this->hasMany(PaymentTypeCustomer::class);
    }
}
