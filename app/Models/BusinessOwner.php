<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'business_title',
        'position',
        'email',
        'phone',
        'facebook',
        'instagram',
        'snap',
        'company_message',
        'vision_statement',
        'thoughts',
        'visibility',
    ];

    protected $casts = [
        'visibility' => 'boolean',
    ];
}
