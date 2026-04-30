<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'property_id',
        'property_slug',
        'property_name',
        'client_name',
        'contact_number',
        'status',
        'is_read',
        'submitted_at',
        'confirmed_at',
        'done_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'submitted_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'done_at' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
