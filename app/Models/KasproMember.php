<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasproMember extends Model
{
    use HasFactory;

    protected $table = 'kaspro_member';

    protected $fillable = [
        'id_user',
        'nama_depan',
        'nama_belakang',
        'msisdn',
        'email',
        'akun_kaspro',
        'partner_token',
        'premium_response_id',
        'akun_kaspro_bank',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
