@extends('admin.app')

@section('page-title', 'Invoice Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Detailed view of invoice</p>
    </div>
    <div>
        <a href="{{ route('admin.invoices.list') }}" class="btn btn-secondary me-2">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
        <div class="btn-group">
            <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-outline-warning">
                <i class="ti ti-edit"></i> Edit
            </a>
            <a href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank" class="btn btn-outline-primary">
                <i class="ti ti-printer"></i> Print
            </a>
            <a href="{{ route('admin.invoices.excel', $invoice->id) }}" target="_blank" class="btn btn-outline-success">
                <i class="ti ti-file-spreadsheet"></i> Excel
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Header Card -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-3">{{ $invoice->invoice_number }}</h4>
                        <div class="mb-2">
                            <strong>Customer:</strong> {{ $invoice->customer->name ?? 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Date:</strong> {{ $invoice->invoice_date ? $invoice->invoice_date->format('M j, Y') : 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Due Date:</strong> {{ $invoice->due_date ? $invoice->due_date->format('M j, Y') : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <div class="mb-3">
                            @php
                                $status = $invoice->payment_status ?? 'unpaid';
                                $badgeClass = match($status) {
                                    'paid' => 'bg-success',
                                    'partial' => 'bg-warning',
                                    'unpaid' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($status) }}</span>
                        </div>
                        <div class="h4 mb-1">${{ number_format($invoice->total_amount ?? 0, 2) }}</div>
                        <div class="text-muted">Total Amount</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Information -->
        @if($invoice->customerVehicle)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Vehicle Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Vehicle:</strong> 
                            {{ $invoice->customerVehicle->year ?? '' }} 
                            {{ $invoice->customerVehicle->make ?? '' }} 
                            {{ $invoice->customerVehicle->model ?? '' }}
                        </div>
                        <div class="mb-2">
                            <strong>Registration:</strong> {{ $invoice->customerVehicle->registration ?? 'Not provided' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>VIN:</strong> {{ $invoice->customerVehicle->vin ?? 'Not provided' }}
                        </div>
                        <div class="mb-2">
                            <strong>Color:</strong> {{ $invoice->customerVehicle->color ?? 'Not provided' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Invoice Items -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    Invoice Items
                    <span class="badge bg-primary ms-2">{{ $invoice->items->count() }}</span>
                </h5>
            </div>
            <div class="card-body p-0">
                @if($invoice->items->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->description ?? 'N/A' }}</strong>
                                    @if($item->notes)
                                        <br><small class="text-muted">{{ $item->notes }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity ?? 0 }}</td>
                                <td class="text-end">${{ number_format($item->unit_price ?? 0, 2) }}</td>
                                <td class="text-end">
                                    <strong>${{ number_format($item->total_price ?? 0, 2) }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Subtotal:</th>
                                <th class="text-end">${{ number_format($invoice->subtotal ?? 0, 2) }}</th>
                            </tr>
                            @if(($invoice->tax_amount ?? 0) > 0)
                            <tr>
                                <th colspan="3" class="text-end">Tax:</th>
                                <th class="text-end">${{ number_format($invoice->tax_amount ?? 0, 2) }}</th>
                            </tr>
                            @endif
                            @if(($invoice->discount_amount ?? 0) > 0)
                            <tr>
                                <th colspan="3" class="text-end">Discount:</th>
                                <th class="text-end">-${{ number_format($invoice->discount_amount ?? 0, 2) }}</th>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3" class="text-end">Total:</th>
                                <th class="text-end">${{ number_format($invoice->total_amount ?? 0, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-shopping-cart-x" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="mt-3">No Items Found</h5>
                    <p class="text-muted">This invoice doesn't have any items.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Notes Section -->
        @if($invoice->notes)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Notes</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $invoice->notes }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Payment Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Payment Summary</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Total Amount:</span>
                            <strong class="h6 mb-0">${{ number_format($invoice->total_amount ?? 0, 2) }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Amount Paid:</span>
                            <span class="text-success h6 mb-0">${{ number_format($invoice->paid_amount ?? 0, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Balance Due:</span>
                            <strong class="h5 mb-0 text-{{ ($invoice->balance_due ?? 0) > 0 ? 'danger' : 'success' }}">
                                ${{ number_format($invoice->balance_due ?? 0, 2) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                @if($invoice->payment_method || $invoice->paid_at)
                <hr>
                @endif

                @if($invoice->payment_method)
                <div class="mb-3">
                    <label class="text-muted small">Payment Method:</label>
                    <div class="fw-bold">{{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</div>
                </div>
                @endif

                @if($invoice->paid_at)
                <div class="mb-3">
                    <label class="text-muted small">Payment Date:</label>
                    <div class="fw-bold">{{ $invoice->paid_at->format('M j, Y g:i A') }}</div>
                </div>
                @endif

                @if($invoice->payment_notes)
                <div class="mb-3">
                    <label class="text-muted small">Payment Notes:</label>
                    <div class="p-2 bg-light rounded">{{ $invoice->payment_notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        @if(($invoice->balance_due ?? 0) > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-success w-100 mb-3" onclick="recordPayment({{ $invoice->id }}, '{{ $invoice->invoice_number }}', {{ $invoice->balance_due ?? 0 }})">
                    <i class="ti ti-credit-card"></i> Record Payment
                </button>
                <a href="{{ route('admin.invoices.edit', $invoice->id) }}" class="btn btn-outline-warning w-100 mb-2">
                    <i class="ti ti-edit"></i> Edit Invoice
                </a>
                <a href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank" class="btn btn-outline-secondary w-100 mb-2">
                    <i class="ti ti-printer"></i> Print Invoice
                </a>
                <a href="{{ route('admin.invoices.excel', $invoice->id) }}" target="_blank" class="btn btn-outline-success w-100">
                    <i class="ti ti-file-spreadsheet"></i> Export to Excel
                </a>
            </div>
        </div>
        @endif

        <!-- Status Alert -->
        @if($invoice->isOverdue())
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle me-2"></i>
                <div>
                    <strong>Overdue Payment</strong><br>
                    <small>Due date was {{ $invoice->due_date->format('M j, Y') }}</small>
                </div>
            </div>
        </div>
        @elseif(($invoice->balance_due ?? 0) == 0)
        <div class="alert alert-success">
            <div class="d-flex align-items-center">
                <i class="ti ti-check-circle me-2"></i>
                <div>
                    <strong>Fully Paid</strong><br>
                    <small>All payments completed</small>
                </div>
            </div>
        </div>
        @endif

        <!-- Customer Info -->
        @if($invoice->customer)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>{{ $invoice->customer->name }}</strong>
                </div>
                @if($invoice->customer->email)
                <div class="mb-2">
                    <i class="ti ti-mail me-1"></i>{{ $invoice->customer->email }}
                </div>
                @endif
                @if($invoice->customer->phone)
                <div class="mb-2">
                    <i class="ti ti-phone me-1"></i>{{ $invoice->customer->phone }}
                </div>
                @endif
                @if($invoice->customer->address)
                <div class="mb-2">
                    <i class="ti ti-map-pin me-1"></i>{{ $invoice->customer->address }}
                </div>
                @endif
                <div class="mt-3">
                    <a href="{{ route('admin.customers.show', $invoice->customer->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="ti ti-user"></i> View Customer
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="paymentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Record Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Recording payment for Invoice: <strong id="invoiceNumber"></strong></p>
                    <div class="mb-3">
                        <label for="payment_amount" class="form-label">Payment Amount</label>
                        <input type="number" name="payment_amount" id="payment_amount" class="form-control" 
                               step="0.01" min="0" required>
                        <small class="text-muted">Maximum: $<span id="maxAmount"></span></small>
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

<script>
function recordPayment(invoiceId, invoiceNumber, balanceDue) {
    document.getElementById('invoiceNumber').textContent = invoiceNumber;
    document.getElementById('payment_amount').value = balanceDue.toFixed(2);
    document.getElementById('payment_amount').max = balanceDue;
    document.getElementById('maxAmount').textContent = balanceDue.toFixed(2);
    document.getElementById('paymentForm').action = `/admin/invoices/${invoiceId}/payment`;
    
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}
</script>
@endsection