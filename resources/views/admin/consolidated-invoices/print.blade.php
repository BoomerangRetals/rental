<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidated Invoice {{ $consolidatedInvoice->consolidated_number }}</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }
        
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .company-info {
            flex: 1;
        }
        
        .invoice-details {
            flex: 1;
            text-align: right;
        }
        
        .customer-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .text-right {
            text-align: right;
        }
        
        .total-section {
            border-top: 2px solid #333;
            padding-top: 15px;
            margin-top: 20px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        
        .total-final {
            font-size: 18px;
            font-weight: bold;
            border-top: 1px solid #333;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-paid { background: #d4edda; color: #155724; }
        .status-partial { background: #fff3cd; color: #856404; }
        .status-pending { background: #f8d7da; color: #721c24; }
        
        .notes {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-top: 20px;
        }
        
        .print-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        
        .print-button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button class="print-button" onclick="window.print()">🖨️ Print This Invoice</button>
    </div>

    <div class="header">
        <h1 class="invoice-title">CONSOLIDATED INVOICE</h1>
    </div>

    <div class="invoice-info">
        <div class="company-info">
            <h3>Boomerang Rentals</h3>
            <p>
                Your reliable vehicle rental service<br>
                Phone: (555) 123-4567<br>
                Email: info@boomerangrentals.com
            </p>
        </div>
        <div class="invoice-details">
            <p>
                <strong>Consolidated #:</strong> {{ $consolidatedInvoice->consolidated_number }}<br>
                <strong>Date:</strong> {{ $consolidatedInvoice->consolidated_date ? $consolidatedInvoice->consolidated_date->format('M j, Y') : 'N/A' }}<br>
                <strong>Due Date:</strong> {{ $consolidatedInvoice->due_date ? $consolidatedInvoice->due_date->format('M j, Y') : 'N/A' }}<br>
                <strong>Status:</strong> 
                @php
                    $status = $consolidatedInvoice->payment_status ?? 'pending';
                    $statusClass = match($status) {
                        'paid' => 'status-paid',
                        'partial' => 'status-partial',
                        'pending' => 'status-pending',
                        default => 'status-pending'
                    };
                @endphp
                <span class="status-badge {{ $statusClass }}">{{ ucfirst($status) }}</span>
            </p>
        </div>
    </div>

    <div class="customer-info">
        <h4>Bill To:</h4>
        <p>
            <strong>{{ $consolidatedInvoice->customer->name ?? 'N/A' }}</strong><br>
            @if($consolidatedInvoice->customer && $consolidatedInvoice->customer->email)
                Email: {{ $consolidatedInvoice->customer->email }}<br>
            @endif
            @if($consolidatedInvoice->customer && $consolidatedInvoice->customer->phone)
                Phone: {{ $consolidatedInvoice->customer->phone }}<br>
            @endif
            @if($consolidatedInvoice->customer && $consolidatedInvoice->customer->address)
                {{ $consolidatedInvoice->customer->address }}
            @endif
        </p>
    </div>

    <h4>Consolidated Invoices with Detailed Items ({{ $consolidatedInvoice->invoices->count() }} invoices)</h4>
    
    @if($consolidatedInvoice->invoices->count() > 0)
        @foreach($consolidatedInvoice->invoices as $invoice)
        <div style="margin-bottom: 40px; border: 1px solid #ddd; padding: 20px; border-radius: 5px;">
            <!-- Invoice Header -->
            <div style="background-color: #f8f9fa; padding: 15px; margin: -20px -20px 20px -20px; border-bottom: 1px solid #ddd; border-radius: 5px 5px 0 0;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <h5 style="margin: 0; color: #333;"><strong>Invoice: {{ $invoice->invoice_number }}</strong></h5>
                        <p style="margin: 5px 0; color: #666;">
                            Date: {{ $invoice->invoice_date ? $invoice->invoice_date->format('M j, Y') : 'N/A' }}
                            @if($invoice->customerVehicle)
                                | Vehicle: {{ $invoice->customerVehicle->year ?? '' }} {{ $invoice->customerVehicle->make ?? '' }} {{ $invoice->customerVehicle->model ?? '' }} ({{ $invoice->customerVehicle->registration ?? 'No Registration' }})
                            @endif
                        </p>
                    </div>
                    <div style="text-align: right;">
                        <h4 style="margin: 0; color: #007bff;">${{ number_format($invoice->pivot->amount ?? $invoice->total_amount ?? 0, 2) }}</h4>
                        @php
                            $invoiceStatus = $invoice->payment_status ?? 'unpaid';
                            $invoiceStatusClass = match($invoiceStatus) {
                                'paid' => 'status-paid',
                                'partial' => 'status-partial',
                                'unpaid' => 'status-pending',
                                default => 'status-pending'
                            };
                        @endphp
                        <span class="status-badge {{ $invoiceStatusClass }}">{{ ucfirst($invoiceStatus) }}</span>
                    </div>
                </div>
            </div>

            <!-- Invoice Items -->
            @if($invoice->items && $invoice->items->count() > 0)
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Item Description</th>
                        <th style="padding: 10px; text-align: center; border: 1px solid #ddd; width: 80px;">Qty</th>
                        <th style="padding: 10px; text-align: right; border: 1px solid #ddd; width: 100px;">Unit Price</th>
                        <th style="padding: 10px; text-align: right; border: 1px solid #ddd; width: 100px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <strong>{{ $item->description ?? 'N/A' }}</strong>
                            @if($item->notes)
                                <br><small style="color: #666;">{{ $item->notes }}</small>
                            @endif
                        </td>
                        <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">{{ $item->quantity ?? 0 }}</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ number_format($item->unit_price ?? 0, 2) }}</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">
                            <strong>${{ number_format($item->total_price ?? 0, 2) }}</strong>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr style="background-color: #f8f9fa;">
                        <td colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd; font-weight: bold;">Subtotal:</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd; font-weight: bold;">${{ number_format($invoice->subtotal ?? 0, 2) }}</td>
                    </tr>
                    @if(($invoice->tax_amount ?? 0) > 0)
                    <tr>
                        <td colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Tax:</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd;">${{ number_format($invoice->tax_amount ?? 0, 2) }}</td>
                    </tr>
                    @endif
                    @if(($invoice->discount_amount ?? 0) > 0)
                    <tr>
                        <td colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd;">Discount:</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd; color: #28a745;">-${{ number_format($invoice->discount_amount ?? 0, 2) }}</td>
                    </tr>
                    @endif
                    <tr style="background-color: #e9ecef;">
                        <td colspan="3" style="padding: 10px; text-align: right; border: 1px solid #ddd; font-weight: bold;">Invoice Total:</td>
                        <td style="padding: 10px; text-align: right; border: 1px solid #ddd; font-weight: bold;">${{ number_format($invoice->total_amount ?? 0, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
            @else
            <p style="margin: 15px 0; font-style: italic; color: #666;">No items found for this invoice.</p>
            @endif
        </div>
        @endforeach

        <!-- Consolidated Summary -->
        <div style="background-color: #007bff; color: white; padding: 20px; border-radius: 5px; text-align: center; margin-top: 30px;">
            <h3 style="margin: 0 0 10px 0;">CONSOLIDATED TOTAL: ${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</h3>
            <p style="margin: 0; opacity: 0.9;">{{ $consolidatedInvoice->invoices->count() }} invoices combined into one consolidated invoice</p>
        </div>
    @else
    <p><em>No invoices included in this consolidated invoice.</em></p>
    @endif

    <div class="total-section">
        <div class="total-row">
            <span><strong>Total Amount:</strong></span>
            <span><strong>${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</strong></span>
        </div>
        <div class="total-row">
            <span>Amount Paid:</span>
            <span>${{ number_format($consolidatedInvoice->paid_amount ?? 0, 2) }}</span>
        </div>
        <div class="total-row total-final">
            <span>Balance Due:</span>
            <span>${{ number_format($consolidatedInvoice->balance_due ?? 0, 2) }}</span>
        </div>
    </div>

    @if($consolidatedInvoice->payment_method || $consolidatedInvoice->paid_at)
    <div style="margin-top: 30px;">
        <h4>Payment Information</h4>
        @if($consolidatedInvoice->payment_method)
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $consolidatedInvoice->payment_method)) }}</p>
        @endif
        @if($consolidatedInvoice->paid_at)
        <p><strong>Payment Date:</strong> {{ $consolidatedInvoice->paid_at->format('M j, Y g:i A') }}</p>
        @endif
        @if($consolidatedInvoice->payment_notes)
        <p><strong>Payment Notes:</strong> {{ $consolidatedInvoice->payment_notes }}</p>
        @endif
    </div>
    @endif

    @if($consolidatedInvoice->notes)
    <div class="notes">
        <h4>Notes</h4>
        <p>{{ $consolidatedInvoice->notes }}</p>
    </div>
    @endif

    <div style="margin-top: 40px; text-align: center; color: #666; font-size: 12px;">
        <p>Thank you for your business!</p>
        <p>Generated on {{ now()->format('M j, Y g:i A') }}</p>
    </div>
</body>
</html>