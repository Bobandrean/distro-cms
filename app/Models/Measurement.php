<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $table = 'satuan_produk';

    protected $fillable = ['name'];

    public function produk()
    {
        return $this->hasMany(Product::class);
    }
}
