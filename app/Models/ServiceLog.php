<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id', 'vehicle_id', 'service_id', 'price', 'discount', 'payment_method', 'notes'
    ];

    public function customer() { return $this->belongsTo(Customer::class); }
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function service() { return $this->belongsTo(Service::class); }
}
