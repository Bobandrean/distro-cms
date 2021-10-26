<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupplierRelation extends Model
{
    use HasFactory;

    protected $table = 'relasi_pembeli_pemasok';

    protected $fillable = [
        'id_pembeli',
        'id_pemasok',
        'id_tipe_pembeli'
    ];

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }

    public function tipe_pembeli()
    {
        return $this->belongsTo(BuyerType::class, 'id_tipe_pembeli');
    }
}
