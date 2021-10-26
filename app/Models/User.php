<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tipe_akun', 'username', 'password', 'permissions', 'api_token', 'status'
    ];

    protected $hidden = [
        'password'
    ];

    public function tipe_akun()
    {
        return $this->belongsTo(Role::class, 'id_tipe_akun');
    }

    public function log_login()
    {
        return $this->hasMany(LogLogin::class);
    }

    public function cms_log()
    {
        return $this->hasMany(CmsLog::class);
    }

    public function fcm()
    {
        return $this->hasMany(FCM::class);
    }

    public function gudang()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function kaspro()
    {
        return $this->hasMany(Kaspro::class);
    }

    public function kaspro_member()
    {
        return $this->hasOne(KasproMember::class, 'id_user');
    }

    public function log_notification()
    {
        return $this->hasMany(LogNotification::class);
    }

    public function pemasok()
    {
        return $this->hasMany(Supplier::class);
    }

    public function pembeli()
    {
        return $this->hasMany(Customer::class);
    }

    public function pengiriman()
    {
        return $this->hasMany(Shipping::class);
    }
}
