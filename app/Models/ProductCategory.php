<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk';

    protected $fillable = ['nama', 'deskripsi', 'ikon', 'hapus'];

    public function katalog_harga()
    {
        return $this->hasMany(PriceCatalogue::class);
    }
}
