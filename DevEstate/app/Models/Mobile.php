<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_name',
        'description',
        'price',
        'tag_one',
        'tag_two',
        'active_tab',
    ];
}
