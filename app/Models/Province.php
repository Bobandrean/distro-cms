<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinsi';

    protected $fillable = ['nama'];

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function kota()
    {
        return $this->hasMany(Regency::class);
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
