<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'country_code',
        'country_name',
    ];

    public function populations()
    {
        return $this->hasMany(Population::class);
    }
}
