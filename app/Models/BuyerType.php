<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerType extends Model
{
    use HasFactory;

    protected $table = 'tipe_pembeli';

    protected $fillable = ['id_pemasok', 'nama', 'keterangan'];

    public function katalog_harga()
    {
        return $this->hasMany(PriceCatalogue::class);
    }

    public function relasi_pembeli_pemasok()
    {
        return $this->hasMany(CustomerSupplierRelation::class);
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }
}
