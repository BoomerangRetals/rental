<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'address', 'license', 'active'];

    public function vehicles()
    {
        return $this->hasMany(CustomerVehicle::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function serviceLogs()
    {
        return $this->hasMany(ServiceLog::class);
    }

    // Get total unpaid amount
    public function getUnpaidAmountAttribute()
    {
        return $this->invoices()->whereIn('payment_status', ['unpaid', 'partial'])->sum('balance_due');
    }

    // Get total paid amount
    public function getTotalPaidAttribute()
    {
        return $this->invoices()->sum('paid_amount');
    }
}
