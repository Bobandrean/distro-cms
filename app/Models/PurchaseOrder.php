<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'po';

    protected $fillable = [
        'kode_po',
        'tanggal',
        'id_pembeli',
        'id_pemasok',
        'id_tipe_pengiriman',
        'id_pembayaran',
        'persen_metode_pembayaran',
        'subtotal',
        'biaya_pengiriman',
        'biaya_layanan',
        'biaya_bunga',
        'total',
        'status_po',
        'old',
        'keterangan',
        'biaya_provisi',
        'nilai_pencairan',
        'nilai_pelunasan'
    ];

    public function do()
    {
        return $this->hasOne(DeliveryOrder::class, 'id_po');
    }

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }

    public function pemasok()
    {
        return $this->belongsTo(Supplier::class, 'id_pemasok');
    }
    public function tipe_pengiriman()
    {
        return $this->belongsTo(ShippingType::class, 'id_tipe_pengiriman');
    }

    public function tipe_pembayaran()
    {
        return $this->belongsTo(PaymentType::class, 'id_pembayaran');
    }

    public function po_barang()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'id_po');
    }

    public function po_billing()
    {
        return $this->hasOne(PurchaseOrderBilling::class, 'id_po');
    }

    public function po_detail()
    {
        return $this->hasOne(PurchaseOrderDetail::class, 'id_po');
    }
}
