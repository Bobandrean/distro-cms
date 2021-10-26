<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceCatalogue extends Model
{
    use HasFactory;

    protected $table = 'katalog_harga';

    protected $fillable = [
        'id_tipe_pembeli',
        'id_produk',
        'id_pemasok',
        'id_kategori',
        'harga_beli',
        'harga_jual',
        'het',
        'laba'
    ];

    public function diskon()
    {
        return $this->hasMany(Discount::class);
    }

    public function tipe_pembeli()
    {
        return $this->belongsTo(BuyerType::class, 'id_tipe_pembeli');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }

    public function kategori_produk()
    {
        return $this->belongsTo(ProductCategory::class, 'id_kategori');
    }
}
