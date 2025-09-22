<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'customer_vehicle_id',
        'invoice_date',
        'due_date',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'paid_amount',
        'balance_due',
        'payment_status',
        'payment_method',
        'notes',
        'payment_notes',
        'status',
        'paid_at',
        'user_id',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_due' => 'decimal:2'
    ];

    // Relationships

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerVehicle()
    {
        return $this->belongsTo(CustomerVehicle::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function consolidatedInvoices()
    {
        return $this->belongsToMany(ConsolidatedInvoice::class, 'consolidated_invoice_items')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    // Auto-generate invoice number
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = static::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber()
    {
        $year = date('Y');
        $month = date('m');
        
        // Get the last invoice number for this month
        $lastInvoice = static::where('invoice_number', 'like', "INV-{$year}{$month}%")
            ->orderBy('invoice_number', 'desc')
            ->first();
        
        if ($lastInvoice) {
            $lastNumber = (int) substr($lastInvoice->invoice_number, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return "INV-{$year}{$month}" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    // Calculate totals
    public function calculateTotals()
    {
        $this->subtotal = (float) $this->items->sum('total_price');
        $this->total_amount = (float) ($this->subtotal + $this->tax_amount - $this->discount_amount);
        $this->balance_due = (float) ($this->total_amount - $this->paid_amount);
        
        // Update payment status
        if ($this->paid_amount >= $this->total_amount) {
            $this->payment_status = 'paid';
            $this->paid_at = $this->paid_at ?: now();
        } elseif ($this->paid_amount > 0) {
            $this->payment_status = 'partial';
        } else {
            $this->payment_status = 'unpaid';
        }
        
        $this->save();
    }

    // Check if overdue
    public function isOverdue()
    {
        return $this->due_date && 
               $this->due_date < now()->toDateString() && 
               $this->payment_status !== 'paid';
    }

    // Scope for unpaid invoices
    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    // Scope for paid invoices
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    // Scope for overdue invoices
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())
                    ->whereIn('payment_status', ['unpaid', 'partial']);
    }
}
