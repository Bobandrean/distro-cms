<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';

    protected $fillable = ['name'];

    public function pemasok()
    {
        return $this->hasMany(Supplier::class);
    }

    public function pembeli()
    {
        return $this->hasMany(Customer::class);
    }
}
