<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'business_title',
        'photo',
        'bio',
        'thoughts',
        'vision_statement',
        'company_message',
        'email',
        'phone',
        'instagram',
        'facebook',
        'snap',
    'visibility'
    ];

    protected $casts = [
        'visibility' => 'boolean',
    ];

    // ...existing code...
}
