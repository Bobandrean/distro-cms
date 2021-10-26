<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    use HasFactory;

    protected $table = 'log_login';

    protected $fillable = ['id_user', 'id_tipe_akun'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tipe_akun()
    {
        return $this->belongsTo(Role::class, 'id_tipe_akun');
    }
}
