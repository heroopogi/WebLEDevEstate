<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'recommended_format',
        'recommended_resolution',
        'cover_priority',
        'success_message',
        'error_message',
    ];
}
