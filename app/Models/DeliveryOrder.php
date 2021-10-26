<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    use HasFactory;

    protected $table = 'do';

    protected $fillable = [
        'id_po',
        'tanggal',
        'kode_do',
        'status_do',
        'foto_bukti_pengiriman',
        'foto_invoice'
    ];

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }
    public function po_detail()
    {
        return $this->hasOne(PurchaseOrderDetail::class, 'id_po');
    }
}
