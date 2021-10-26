<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $table = 'kota';

    protected $fillable = ['id_provinsi', 'nama'];

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function kecamatan()
    {
        return $this->hasMany(District::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class);
    }

    public function pemasok()
    {
        return $this->hasMany(Supplier::class);
    }

    public function pembeli()
    {
        return $this->hasMany(Customer::class);
    }

    public function pengiriman()
    {
        return $this->hasMany(Shipping::class);
    }
}
