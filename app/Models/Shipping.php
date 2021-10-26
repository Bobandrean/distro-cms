<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [
        'id_user',
        'id_gudang',
        'kelurahan',
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
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function gudang()
    {
        return $this->belongsTo(Warehouse::class, 'id_gudang');
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
}
