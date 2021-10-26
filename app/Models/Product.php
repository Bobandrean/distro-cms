<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_pemasok',
        'id_kategori_produk',
        'id_satuan_produk',
        'id_jenis_kemasan',
        'kode',
        'nama',
        'deskripsi',
        'berat',
        'isi_kemasan',
        'panjang',
        'lebar',
        'tinggi',
        'ppn',
        'harga_dasar',
        'harga',
        'foto_1',
        'foto_2',
        'foto_3',
        'hapus'
    ];

    public function katalog_harga()
    {
        return $this->hasMany(PriceCatalogue::class);
    }

    public function keranjang_detail()
    {
        return $this->hasMany(CartDetail::class);
    }

    public function po_barang()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }

    public function kategori_produk()
    {
        return $this->belongsTo(ProductCategory::class, 'id_kategori_produk');
    }

    public function satuan_produk()
    {
        return $this->belongsTo(Measurement::class, 'id_satuan_produk');
    }

    public function jenis_kemasan()
    {
        return $this->belongsTo(Packaging::class, 'id_jenis_kemasan');
    }

    public function stok_barang()
    {
        return $this->hasMany(Stock::class);
    }
}
