<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'pemasok';

    protected $fillable = [
        'id_user',
        'id_job',
        'nama_perusahaan',
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
        'longitude',
        'nomor_rekening',
        'nama_bank',
        'nama_pemegang_rekening',
        'logo'
    ];

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function katalog_harga()
    {
        return $this->hasMany(PriceCatalogue::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Cart::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'kelurahan');
    }

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function relasi_pembeli_pemasok()
    {
        return $this->hasMany(CustomerSupplierRelation::class, 'id_pemasok');
    }

    public function tipe_pembeli()
    {
        return $this->hasMany(BuyerType::class);
    }
}
