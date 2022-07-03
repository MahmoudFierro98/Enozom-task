<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    public function format()
    {
        return [
            'code' => $this->code,
            'year' => $this->year,
            'value' => $this->value,
            'country' => $this->country->country_name,
        ];
    }
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
