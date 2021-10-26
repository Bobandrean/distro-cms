<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogNotification extends Model
{
    use HasFactory;

    protected $table = 'log_notification';

    protected $fillable = [
      'id_user', 'title', 'notification', 'data'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
