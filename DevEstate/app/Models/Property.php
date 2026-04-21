<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'badge',
        'property_type',
        'location',
        'description',
        'price',
        'bedrooms',
        'bathrooms',
        'floor_area',
        'lot_area',
        'parking_spaces',
        'image_path',
    ];
}
