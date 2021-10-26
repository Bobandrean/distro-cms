<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerGratia extends Model
{
    use HasFactory;

    protected $table = 'banner_gratia';

    protected $fillable = [
        'name', 'img_url'
    ];
}
