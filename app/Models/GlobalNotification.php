<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalNotification extends Model
{
    use HasFactory;

    protected $table = 'global_notification';

    protected $fillable = [
        'title', 'notification', 'data'
    ];
}
