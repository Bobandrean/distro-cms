<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'saran_dan_keluhan';

    protected $fillable = ['id_pembeli', 'sarankeluhan'];

    public function pembeli()
    {
        return $this->belongsTo(Customer::class, 'id_pembeli');
    }
}
