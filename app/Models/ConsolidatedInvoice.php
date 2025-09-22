<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ConsolidatedInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'consolidated_number',
        'customer_id',
        'consolidated_date',
        'due_date',
        'total_amount',
        'paid_amount',
        'balance_due',
        'payment_status',
        'payment_method',
        'paid_at',
        'payment_notes',
        'notes'
    ];

    protected $casts = [
        'consolidated_date' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance_due' => 'decimal:2'
    ];

    public static function generateConsolidatedNumber()
    {
        $year = date('Y');
        $month = date('m');
        $prefix = 'CONS';
        
        $lastInvoice = static::where('consolidated_number', 'like', "{$prefix}-{$year}{$month}%")
                           ->orderBy('consolidated_number', 'desc')
                           ->first();
        
        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice->consolidated_number, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        
        return "{$prefix}-{$year}{$month}{$newNumber}";
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'consolidated_invoice_items')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function calculateTotals()
    {
        $this->total_amount = $this->invoices->sum('pivot.amount');
        $this->balance_due = $this->total_amount - $this->paid_amount;
        
        if ($this->paid_amount == 0) {
            $this->payment_status = 'unpaid';
        } elseif ($this->paid_amount >= $this->total_amount) {
            $this->payment_status = 'paid';
            $this->balance_due = 0;
        } else {
            $this->payment_status = 'partial';
        }
        
        $this->save();
    }

    public function isOverdue()
    {
        return $this->due_date && 
               $this->due_date->isPast() && 
               in_array($this->payment_status, ['unpaid', 'partial']);
    }

    public function markInvoicesAsPaid()
    {
        foreach ($this->invoices as $invoice) {
            $invoice->update([
                'paid_amount' => $invoice->total_amount,
                'balance_due' => 0,
                'payment_status' => 'paid',
                'payment_method' => $this->payment_method,
                'paid_at' => $this->paid_at,
                'payment_notes' => "Paid via consolidated invoice {$this->consolidated_number}"
            ]);
        }
    }

    public function updateInvoicesForPartialPayment($paymentAmount)
    {
        $totalInvoicesAmount = $this->invoices->sum('total_amount');
        $remainingPayment = $paymentAmount;

        foreach ($this->invoices as $invoice) {
            // Calculate proportional payment for this invoice
            $invoiceRatio = $invoice->total_amount / $totalInvoicesAmount;
            $invoicePayment = min($remainingPayment, $invoice->total_amount * $invoiceRatio);
            
            // Update invoice payment details
            $invoice->paid_amount = ($invoice->paid_amount ?? 0) + $invoicePayment;
            $invoice->balance_due = $invoice->total_amount - $invoice->paid_amount;
            
            // Determine payment status
            if ($invoice->balance_due <= 0) {
                $invoice->payment_status = 'paid';
                $invoice->paid_at = now();
                $invoice->balance_due = 0;
            } elseif ($invoice->paid_amount > 0) {
                $invoice->payment_status = 'partial';
            } else {
                $invoice->payment_status = 'unpaid';
            }

            $invoice->payment_method = $this->payment_method;
            $invoice->payment_notes = "Partial payment via consolidated invoice {$this->consolidated_number}";
            $invoice->save();

            $remainingPayment -= $invoicePayment;
        }
    }
}
