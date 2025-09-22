<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerVehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'brand',
        'model',
        'year',
        'registration_number',
        'vin',
        'colour',
        'transmission',
        'fuel',
        'body_type',
        'engine_no',
        'odometer_reading',
        'notes',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(ServiceLog::class, 'vehicle_id');
    }
}
