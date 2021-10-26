<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FCM extends Model
{
    use HasFactory;

    protected $table = 'fcm';

    protected $fillable = [
        'id_user', 'device_id', 'platform', 'fcm_token'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
