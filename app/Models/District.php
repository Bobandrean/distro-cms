<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $fillable = ['id_kota'];

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'id_kota');
    }

    public function kelurahan()
    {
        return $this->hasMany(Village::class);
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
