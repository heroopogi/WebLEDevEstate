<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'location',
        'description',
        'bedrooms',
        'bathrooms',
        'area_sqft',
        'price',
    ];
}
