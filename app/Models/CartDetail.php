<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = 'keranjang_detail';

    protected $fillable = [
        'id_keranjang',
        'id_produk',
        'jumlah'
    ];

    public function keranjang()
    {
        return $this->belongsTo(Cart::class, 'id_keranjang');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
