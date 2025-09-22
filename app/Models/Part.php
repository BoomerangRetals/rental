<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'part_number', 'make', 'model', 'year', 'quantity', 'cost', 'price', 'status', 'type', 'visibility', 'supplier', 'reorder_level', 'thumbnail', 'images'
    ];

    protected $casts = [
        'images' => 'array',
        'cost' => 'decimal:2',
        'price' => 'decimal:2',
        'status' => 'boolean',
        'visibility' => 'boolean',
    ];
}
