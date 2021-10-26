<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'gudang';

    protected $fillable = [
        'id_user',
        'id_pemasok',
        'nama_gudang',
        'nama_pic',
        'msisdn',
        'email',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'latitude',
        'longitude'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function kota()
    {
        return $this->belongsTo(Regency::class, 'kota');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Village::class, 'kelurahan');
    }

    public function pengiriman()
    {
        return $this->hasMany(Shipping::class);
    }

    public function stok_barang()
    {
        return $this->hasMany(Stock::class);
    }
}
