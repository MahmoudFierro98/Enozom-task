<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'year',
        'value',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
