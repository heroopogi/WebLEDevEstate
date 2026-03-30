<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'subheadline',
        'email_hint',
        'password_hint',
        'remember_text',
        'forgot_text',
    ];
}
