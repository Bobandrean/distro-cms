<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsLog extends Model
{
    use HasFactory;

    protected $table = 'cms_log';

    protected $fillable = [
        'id_user', 'log'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
