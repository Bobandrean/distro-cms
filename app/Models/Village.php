<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $table = 'kelurahan';

    protected $fillable = ['id_kecamatan', 'nama'];

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'id_kecamatan');
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
