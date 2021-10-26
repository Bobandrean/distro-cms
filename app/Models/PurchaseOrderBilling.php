<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderBilling extends Model
{
    use HasFactory;

    protected $table = 'po_billing';

    protected $fillable = [
        'id_po',
        'nama_depan',
        'nama_belakang',
        'nama_usaha',
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

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }
}
