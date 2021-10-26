<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'diskon';

    protected $fillable = [
        'name', 'id_katalog_harga', 'minimal_belanja', 'tipe_diskon', 'diskon', 'harga_sebelum_diskon', 'harga_setelah_diskon'
    ];

    public function katalog_harga()
    {
        return $this->belongsTo(PriceCatalogue::class, 'id_katalog_harga');
    }
}
