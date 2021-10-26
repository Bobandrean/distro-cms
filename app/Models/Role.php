<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'tipe_akun';

    protected $fillable = ['nama', 'slug', 'permissions'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function log_login()
    {
        return $this->hasMany(LogLogin::class);
    }
}
