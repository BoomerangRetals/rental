<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'year',
        'registration_number',
        'vin',
        'colour',
        'seats',
        'doors',
        'weekly',
        'transmission',
        'fuel',
        'body_type',
        'engine_no',
        'series',
        'reference',
        'tracker',
        'tracker_details',
        'bond',
        'thumbnail',
        'vehicle_type',
        'visibility',
        'ready',
        'terms',
        'images',
        'status',
    ];

    protected $casts = [
        'tracker' => 'boolean',
        'visibility' => 'boolean',
        'ready' => 'boolean',
        'status' => 'boolean',
        'terms' => 'array',
        'images' => 'array',
    ];
}
