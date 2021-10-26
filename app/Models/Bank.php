<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = 'bank';

    protected $fillable = [
        'bank_code', 'bank_name', 'network', 'ibayad_code'
    ];
}
