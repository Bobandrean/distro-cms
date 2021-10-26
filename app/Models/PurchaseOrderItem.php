<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $table = 'po_barang';

    protected $fillable = ['id_po', 'id_produk', 'jumlah', 'harga', 'total'];

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }

    public function produk()
    {
        return $this->belongsTo(Product::class, 'id_produk');
    }
}
