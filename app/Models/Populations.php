<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Populations extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'year',
        'value',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
