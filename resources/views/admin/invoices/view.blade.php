@extends('admin.app')

@section('title', 'Invoice #' . $invoice->invoice_number)

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Invoice #{{ $invoice->invoice_number }}</h1>
        <div>
            <a href="{{ route('admin.invoices.list') }}" class="btn btn-secondary me-2">
                <i class="bx bx-arrow-back"></i> Back to Invoices
            </a>
            <a href="{{ route('admin.invoices.print', $invoice->id) }}" class="btn btn-info me-2" target="_blank">
                <i class="bx bx-printer"></i> Print
            </a>
            <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-warning me-2">
                <i class="bx bx-edit"></i> Edit
            </a>
            @if($invoice->payment_status !== 'paid')
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                <i class="bx bx-dollar"></i> Record Payment
            </button>
            @endif
        </div>
    </div>

    <div class="row">
        <!-- Invoice Details -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Bill To:</h6>
                            <strong>{{ $invoice->customer->name }}</strong><br>
                            {{ $invoice->customer->email }}<br>
                            {{ $invoice->customer->phone }}<br>
                            {{ $invoice->customer->address }}
                        </div>
                        <div class="col-md-6 text-end">
                            <h6>Vehicle Information:</h6>
                            <strong>{{ $invoice->customerVehicle->registration_number }}</strong><br>
                            {{ $invoice->customerVehicle->brand }} {{ $invoice->customerVehicle->model }}<br>
                            @if($invoice->customerVehicle->year)
                                Year: {{ $invoice->customerVehicle->year }}<br>
                            @endif
                            @if($invoice->customerVehicle->colour)
                                Colour: {{ $invoice->customerVehicle->colour }}
                            @endif
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <strong>Invoice Date:</strong><br>
                            {{ $invoice->invoice_date->format('M j, Y') }}
                        </div>
                        <div class="col-md-4">
                            <strong>Due Date:</strong><br>
                            {{ $invoice->due_date ? $invoice->due_date->format('M j, Y') : 'N/A' }}
                        </div>
                        <div class="col-md-4">
                            <strong>Status:</strong><br>
                            @if($invoice->payment_status === 'paid')
                                <span class="badge bg-success">Paid</span>
                            @elseif($invoice->payment_status === 'partial')
                                <span class="badge bg-warning">Partial</span>
                            @else
                                <span class="badge bg-danger">Unpaid</span>
                            @endif
                            
                            @if($invoice->isOverdue())
                                <span class="badge bg-danger ms-1">Overdue</span>
                            @endif
                        </div>
                    </div>

                    <!-- Invoice Items -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Description</th>
                                    <th width="15%">Qty</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($invoice->items as $item)
                                <tr>
                                    <td>
                                        {{ $item->description }}
                                        @if($item->notes)
                                            <br><small class="text-muted">{{ $item->notes }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                    <td>${{ number_format($item->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($invoice->notes)
                    <div class="mt-4">
                        <h6>Notes:</h6>
                        <p class="text-muted">{{ $invoice->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Invoice Summary -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Invoice Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6">Subtotal:</div>
                        <div class="col-6 text-end">${{ number_format($invoice->subtotal, 2) }}</div>
                    </div>
                    @if($invoice->tax_amount > 0)
                    <div class="row mb-2">
                        <div class="col-6">Tax:</div>
                        <div class="col-6 text-end">${{ number_format($invoice->tax_amount, 2) }}</div>
                    </div>
                    @endif
                    @if($invoice->discount_amount > 0)
                    <div class="row mb-2">
                        <div class="col-6">Discount:</div>
                        <div class="col-6 text-end">-${{ number_format($invoice->discount_amount, 2) }}</div>
                    </div>
                    @endif
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6"><strong>Total:</strong></div>
                        <div class="col-6 text-end"><strong>${{ number_format($invoice->total_amount, 2) }}</strong></div>
                    </div>
                    
                    @if($invoice->paid_amount > 0)
                    <div class="row mb-2">
                        <div class="col-6 text-success">Paid:</div>
                        <div class="col-6 text-end text-success">${{ number_format($invoice->paid_amount, 2) }}</div>
                    </div>
                    @endif
                    
                    @if($invoice->balance_due > 0)
                    <div class="row">
                        <div class="col-6 text-danger"><strong>Balance Due:</strong></div>
                        <div class="col-6 text-end text-danger"><strong>${{ number_format($invoice->balance_due, 2) }}</strong></div>
                    </div>
                    @endif

                    @if($invoice->payment_method)
                    <hr>
                    <div class="row">
                        <div class="col-6">Payment Method:</div>
                        <div class="col-6 text-end">{{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</div>
                    </div>
                    @endif

                    @if($invoice->paid_at)
                    <div class="row">
                        <div class="col-6">Paid Date:</div>
                        <div class="col-6 text-end">{{ $invoice->paid_at->format('M j, Y') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Customer Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.customers.view', $invoice->customer->id) }}" class="btn btn-outline-primary w-100 mb-2">
                        <i class="bx bx-user"></i> View Customer Profile
                    </a>
                    <a href="{{ route('admin.invoices.customer', $invoice->customer->id) }}" class="btn btn-outline-info w-100 mb-2">
                        <i class="bx bx-file-blank"></i> Customer's All Invoices
                    </a>
                    <a href="{{ route('admin.invoices.create') }}?customer_id={{ $invoice->customer->id }}" class="btn btn-outline-success w-100">
                        <i class="bx bx-plus"></i> Create New Invoice
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
@if($invoice->payment_status !== 'paid')
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.invoices.payment', $invoice->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Record Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="payment_amount" class="form-label">Payment Amount</label>
                        <input type="number" name="payment_amount" id="payment_amount" class="form-control" 
                               step="0.01" min="0" max="{{ $invoice->balance_due }}" 
                               value="{{ $invoice->balance_due }}" required>
                        <small class="text-muted">Maximum: ${{ number_format($invoice->balance_due, 2) }}</small>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="card">Card</option>
                            <option value="online">Online Payment</option>
                            <option value="abn">ABN</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_notes" class="form-label">Payment Notes</label>
                        <textarea name="payment_notes" id="payment_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Record Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection