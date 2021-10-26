<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingType extends Model
{
    use HasFactory;

    protected $table = 'tipe_pengiriman';

    protected $fillable = ['nama', 'keterangan', 'biaya'];

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
