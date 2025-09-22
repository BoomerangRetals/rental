<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    
    @php
        $invoiceColor = \App\Models\Setting::get('invoice_color', '#007bff');
        $companyName = \App\Models\Setting::get('company_name', 'Boomerang Rentals');
        $companyAddress = \App\Models\Setting::get('company_address', '123 Business Street, City, State 12345');
        $companyPhone = \App\Models\Setting::get('company_phone', '(555) 123-4567');
        $companyEmail = \App\Models\Setting::get('company_email', 'info@boomerangrentals.com');
        $companyAbn = \App\Models\Setting::get('company_abn', '12 345 678 901');
        $companyLogo = \App\Models\Setting::get('company_logo', '');
        $showLogo = \App\Models\Setting::get('show_invoice_logo', '1');
        $invoiceFooter = \App\Models\Setting::get('invoice_footer', 'Thank you for your business!');
    @endphp
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
            color: #333;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
        }
        
        .invoice-header {
            border-bottom: 2px solid {{ $invoiceColor }};
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-info {
            text-align: right;
            float: right;
            width: 300px;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: {{ $invoiceColor }};
            margin-bottom: 10px;
        }
        
        .company-details {
            font-size: 12px;
            line-height: 1.5;
            color: #666;
        }
        
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .invoice-number {
            font-size: 16px;
            color: #666;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        
        .invoice-details {
            margin-bottom: 30px;
        }
        
        .bill-to {
            float: left;
            width: 45%;
        }
        
        .invoice-meta {
            float: right;
            width: 45%;
            text-align: right;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: {{ $invoiceColor }};
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .customer-details {
            font-size: 14px;
            line-height: 1.6;
        }
        
        .customer-name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .vehicle-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid {{ $invoiceColor }};
        }
        
        .vehicle-title {
            font-weight: bold;
            color: {{ $invoiceColor }};
            margin-bottom: 8px;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            font-size: 14px;
        }
        
        .items-table th {
            background: {{ $invoiceColor }};
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
        }
        
        .items-table td {
            padding: 12px 8px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .items-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .totals-section {
            float: right;
            width: 300px;
            margin-top: 20px;
        }
        
        .totals-table {
            width: 100%;
            font-size: 14px;
        }
        
        .totals-table td {
            padding: 8px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .total-row {
            font-weight: bold;
            font-size: 16px;
            color: {{ $invoiceColor }};
            border-top: 2px solid {{ $invoiceColor }};
        }
        
        .payment-info {
            margin-top: 40px;
            clear: both;
        }
        
        .payment-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }
        
        .status-paid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-partial {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .status-unpaid {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .status-overdue {
            background: #dc3545;
            color: white;
            border: 1px solid #dc3545;
        }
        
        .notes-section {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }
        
        .notes-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-style: italic;
            color: #666;
        }
        
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .invoice-container {
                max-width: none;
                padding: 20px;
            }
            
            .no-print {
                display: none !important;
            }
        }
        
        .print-buttons {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            background: {{ $invoiceColor }};
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        
        .btn:hover {
            background: {{ $invoiceColor }}cc;
        }
        
        .btn-secondary {
            background: #6c757d;
        }
        
        .btn-secondary:hover {
            background: #545b62;
        }
    </style>
</head>
<body>
    <div class="print-buttons no-print">
        <button onclick="window.print()" class="btn">Print Invoice</button>
        <a href="{{ route('admin.invoices.view', $invoice->id) }}" class="btn btn-secondary">Back to Invoice</a>
    </div>

    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header clearfix">
            <div class="company-info">
                @if($showLogo && $companyLogo)
                    <div class="mb-3">
                        <img src="{{ $companyLogo }}" alt="{{ $companyName }}" style="max-height: 80px;">
                    </div>
                @endif
                <div class="company-name">{{ $companyName }}</div>
                <div class="company-details">
                    {!! nl2br(e($companyAddress)) !!}<br>
                    @if($companyPhone)
                        Phone: {{ $companyPhone }}<br>
                    @endif
                    @if($companyEmail)
                        Email: {{ $companyEmail }}<br>
                    @endif
                    @if($companyAbn)
                        ABN: {{ $companyAbn }}
                    @endif
                </div>
            </div>
            <div class="invoice-title">INVOICE</div>
            <div class="invoice-number">#{{ $invoice->invoice_number }}</div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details clearfix">
            <div class="bill-to">
                <div class="section-title">Bill To:</div>
                <div class="customer-details">
                    <div class="customer-name">{{ $invoice->customer->name }}</div>
                    @if($invoice->customer->email)
                        {{ $invoice->customer->email }}<br>
                    @endif
                    @if($invoice->customer->phone)
                        {{ $invoice->customer->phone }}<br>
                    @endif
                    @if($invoice->customer->address)
                        {{ $invoice->customer->address }}
                    @endif
                </div>
            </div>
            
            <div class="invoice-meta">
                <div class="section-title">Invoice Details:</div>
                <div class="customer-details">
                    <strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('M j, Y') }}<br>
                    @if($invoice->due_date)
                        <strong>Due Date:</strong> {{ $invoice->due_date->format('M j, Y') }}<br>
                    @endif
                    <strong>Status:</strong> 
                    @if($invoice->payment_status === 'paid')
                        <span class="payment-status status-paid">Paid</span>
                    @elseif($invoice->payment_status === 'partial')
                        <span class="payment-status status-partial">Partial</span>
                    @else
                        <span class="payment-status status-unpaid">Unpaid</span>
                    @endif
                    
                    @if($invoice->isOverdue())
                        <br><span class="payment-status status-overdue">Overdue</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Vehicle Information -->
        <div class="vehicle-info">
            <div class="vehicle-title">Vehicle Information</div>
            <strong>Registration:</strong> {{ $invoice->customerVehicle->registration_number ?? 'N/A' }}<br>
            <strong>Make & Model:</strong> {{ $invoice->customerVehicle->brand ?? 'N/A' }} {{ $invoice->customerVehicle->model ?? 'N/A' }}<br>
            @if($invoice->customerVehicle->year)
                <strong>Year:</strong> {{ $invoice->customerVehicle->year }}<br>
            @endif
            @if($invoice->customerVehicle->colour)
                <strong>Colour:</strong> {{ $invoice->customerVehicle->colour }}<br>
            @endif
            @if($invoice->customerVehicle->vin)
                <strong>VIN:</strong> {{ $invoice->customerVehicle->vin }}
            @endif
        </div>

        <!-- Invoice Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Description</th>
                    <th style="width: 15%;" class="text-center">Qty</th>
                    <th style="width: 17.5%;" class="text-right">Unit Price</th>
                    <th style="width: 17.5%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->items as $item)
                <tr>
                    <td>
                        {{ $item->description }}
                        @if($item->notes)
                            <br><small style="color: #666;">{{ $item->notes }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">${{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <table class="totals-table">
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">${{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                @if($invoice->tax_amount > 0)
                <tr>
                    <td>Tax:</td>
                    <td class="text-right">${{ number_format($invoice->tax_amount, 2) }}</td>
                </tr>
                @endif
                @if($invoice->discount_amount > 0)
                <tr>
                    <td>Discount:</td>
                    <td class="text-right">-${{ number_format($invoice->discount_amount, 2) }}</td>
                </tr>
                @endif
                <tr class="total-row">
                    <td><strong>Total:</strong></td>
                    <td class="text-right"><strong>${{ number_format($invoice->total_amount, 2) }}</strong></td>
                </tr>
                @if($invoice->paid_amount > 0)
                <tr>
                    <td style="color: #28a745;">Amount Paid:</td>
                    <td class="text-right" style="color: #28a745;">${{ number_format($invoice->paid_amount, 2) }}</td>
                </tr>
                @endif
                @if($invoice->balance_due > 0)
                <tr>
                    <td style="color: #dc3545;"><strong>Balance Due:</strong></td>
                    <td class="text-right" style="color: #dc3545;"><strong>${{ number_format($invoice->balance_due, 2) }}</strong></td>
                </tr>
                @endif
            </table>
        </div>

        <!-- Payment Information -->
        @if($invoice->payment_method || $invoice->paid_at)
        <div class="payment-info clearfix">
            <div class="section-title">Payment Information</div>
            @if($invoice->payment_method)
                <strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}<br>
            @endif
            @if($invoice->paid_at)
                <strong>Payment Date:</strong> {{ $invoice->paid_at->format('M j, Y g:i A') }}<br>
            @endif
            @if($invoice->payment_notes)
                <strong>Payment Notes:</strong> {{ $invoice->payment_notes }}
            @endif
        </div>
        @endif

        <!-- Notes -->
        @if($invoice->notes)
        <div class="notes-section">
            <div class="section-title">Notes</div>
            <div class="notes-content">
                {{ $invoice->notes }}
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>{{ $invoiceFooter }}</p>
            <p>If you have any questions about this invoice, please contact us at {{ $companyEmail }} or {{ $companyPhone }}</p>
        </div>
    </div>

    <script>
        // Auto-print when opened in a new window
        window.onload = function() {
            if (window.location.search.includes('auto=1')) {
                window.print();
            }
        };
    </script>
</body>
</html>