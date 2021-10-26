<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stok_barang';

    protected $fillable = [
        'id_gudang',
        'id_produk',
        'jumlah_stok',
        'stok_minimum'
    ];

    public function gudang()
    {
        return $this->belongsTo(Warehouse::class, 'id_gudang');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
