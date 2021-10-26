<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = ['id_pembeli', 'id_pemasok'];

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }

    public function keranjang()
    {
        return $this->hasMany(CartDetail::class);
    }
}
