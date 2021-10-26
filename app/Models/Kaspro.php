<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaspro extends Model
{
    use HasFactory;

    protected $table = 'kaspro';

    protected $fillable = [
        'id_user',
        'nama',
        'email',
        'no_telepon',
        'alamat'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
