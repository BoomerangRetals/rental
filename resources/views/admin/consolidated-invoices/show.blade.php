@extends('admin.app')

@section('page-title', 'Consolidated Invoice Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Detailed view of consolidated invoice</p>
    </div>
    <div>
        <a href="{{ route('admin.consolidated-invoices.list') }}" class="btn btn-secondary me-2">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
        <div class="btn-group">
            <a href="{{ route('admin.consolidated-invoices.download', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-primary">
                <i class="ti ti-download"></i> Download
            </a>
            <a href="{{ route('admin.consolidated-invoices.print', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-primary">
                <i class="ti ti-printer"></i> Print
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
                        <h4 class="mb-3">{{ $consolidatedInvoice->consolidated_number }}</h4>
                        <div class="mb-2">
                            <strong>Customer:</strong> {{ $consolidatedInvoice->customer->name ?? 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Date:</strong> {{ $consolidatedInvoice->consolidated_date ? $consolidatedInvoice->consolidated_date->format('M j, Y') : 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Due Date:</strong> {{ $consolidatedInvoice->due_date ? $consolidatedInvoice->due_date->format('M j, Y') : 'N/A' }}
                        </div>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <div class="mb-3">
                            @php
                                $status = $consolidatedInvoice->payment_status ?? 'pending';
                                $badgeClass = match($status) {
                                    'paid' => 'bg-success',
                                    'partial' => 'bg-warning',
                                    'pending' => 'bg-secondary',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($status) }}</span>
                        </div>
                        <div class="h4 mb-1">${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</div>
                        <div class="text-muted">Total Amount</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoices Included -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    Included Invoices
                    <span class="badge bg-primary ms-2">{{ $consolidatedInvoice->invoices->count() }}</span>
                </h5>
            </div>
            <div class="card-body p-0">
                @if($consolidatedInvoice->invoices->count() > 0)
                    @foreach($consolidatedInvoice->invoices as $invoice)
                    <div class="invoice-section border-bottom">
                        <!-- Invoice Header -->
                        <div class="p-3 bg-light">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h6 class="mb-1">
                                        <strong>{{ $invoice->invoice_number }}</strong>
                                        <span class="text-muted">- {{ $invoice->invoice_date ? $invoice->invoice_date->format('M j, Y') : 'N/A' }}</span>
                                    </h6>
                                    @if($invoice->customerVehicle)
                                        <small class="text-muted">
                                            {{ $invoice->customerVehicle->year ?? '' }} 
                                            {{ $invoice->customerVehicle->make ?? '' }} 
                                            {{ $invoice->customerVehicle->model ?? '' }}
                                            ({{ $invoice->customerVehicle->registration ?? 'No Registration' }})
                                        </small>
                                    @endif
                                </div>
                                <div class="col-md-3 text-center">
                                    @php
                                        $invoiceStatus = $invoice->payment_status ?? 'unpaid';
                                        $invoiceBadgeClass = match($invoiceStatus) {
                                            'paid' => 'bg-success',
                                            'partial' => 'bg-warning',
                                            'unpaid' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $invoiceBadgeClass }}">{{ ucfirst($invoiceStatus) }}</span>
                                </div>
                                <div class="col-md-3 text-end">
                                    <strong class="h6">${{ number_format($invoice->pivot->amount ?? $invoice->total_amount ?? 0, 2) }}</strong>
                                    <br>
                                    <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Items -->
                        @if($invoice->items && $invoice->items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item Description</th>
                                        <th class="text-center" width="100">Qty</th>
                                        <th class="text-end" width="120">Unit Price</th>
                                        <th class="text-end" width="120">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->items as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $item->description ?? 'N/A' }}</div>
                                            @if($item->notes)
                                                <small class="text-muted">{{ $item->notes }}</small>
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
                                        <td colspan="3" class="text-end fw-bold">Subtotal:</td>
                                        <td class="text-end fw-bold">${{ number_format($invoice->subtotal ?? 0, 2) }}</td>
                                    </tr>
                                    @if(($invoice->tax_amount ?? 0) > 0)
                                    <tr>
                                        <td colspan="3" class="text-end">Tax:</td>
                                        <td class="text-end">${{ number_format($invoice->tax_amount ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                    @if(($invoice->discount_amount ?? 0) > 0)
                                    <tr>
                                        <td colspan="3" class="text-end">Discount:</td>
                                        <td class="text-end text-success">-${{ number_format($invoice->discount_amount ?? 0, 2) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Invoice Total:</td>
                                        <td class="text-end fw-bold">${{ number_format($invoice->total_amount ?? 0, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        @else
                        <div class="p-3">
                            <em class="text-muted">No items found for this invoice.</em>
                        </div>
                        @endif
                    </div>
                    @endforeach

                    <!-- Consolidated Total -->
                    <div class="p-3 bg-primary text-white">
                        <div class="row">
                            <div class="col-md-9">
                                <h6 class="mb-0">Consolidated Invoice Total</h6>
                                <small>{{ $consolidatedInvoice->invoices->count() }} invoices combined</small>
                            </div>
                            <div class="col-md-3 text-end">
                                <h5 class="mb-0">${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                @else
                <div class="text-center py-5">
                    <i class="ti ti-file-x" style="font-size: 4rem; color: #ccc;"></i>
                    <h5 class="mt-3">No Invoices Included</h5>
                    <p class="text-muted">This consolidated invoice doesn't have any associated invoices.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Notes Section -->
        @if($consolidatedInvoice->notes)
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Notes</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $consolidatedInvoice->notes }}</p>
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
                            <strong class="h6 mb-0">${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Amount Paid:</span>
                            <span class="text-success h6 mb-0">${{ number_format($consolidatedInvoice->paid_amount ?? 0, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="my-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Balance Due:</span>
                            <strong class="h5 mb-0 text-{{ ($consolidatedInvoice->balance_due ?? 0) > 0 ? 'danger' : 'success' }}">
                                ${{ number_format($consolidatedInvoice->balance_due ?? 0, 2) }}
                            </strong>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                @if($consolidatedInvoice->payment_method || $consolidatedInvoice->paid_at)
                <hr>
                @endif

                @if($consolidatedInvoice->payment_method)
                <div class="mb-3">
                    <label class="text-muted small">Payment Method:</label>
                    <div class="fw-bold">{{ ucfirst(str_replace('_', ' ', $consolidatedInvoice->payment_method)) }}</div>
                </div>
                @endif

                @if($consolidatedInvoice->paid_at)
                <div class="mb-3">
                    <label class="text-muted small">Payment Date:</label>
                    <div class="fw-bold">{{ $consolidatedInvoice->paid_at->format('M j, Y g:i A') }}</div>
                </div>
                @endif

                @if($consolidatedInvoice->payment_notes)
                <div class="mb-3">
                    <label class="text-muted small">Payment Notes:</label>
                    <div class="p-2 bg-light rounded">{{ $consolidatedInvoice->payment_notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        @if(($consolidatedInvoice->balance_due ?? 0) > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                @php
                    $balanceDue = number_format($consolidatedInvoice->balance_due ?? 0, 2, '.', '');
                @endphp
                <button class="btn btn-success w-100 mb-3" onclick="recordPayment({{ $consolidatedInvoice->id }}, '{{ $consolidatedInvoice->consolidated_number }}', {{ $balanceDue }})">
                    <i class="ti ti-credit-card"></i> Record Payment
                </button>
                <a href="{{ route('admin.consolidated-invoices.download', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-primary w-100 mb-2">
                    <i class="ti ti-download"></i> Download PDF
                </a>
                <a href="{{ route('admin.consolidated-invoices.excel', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-success w-100 mb-2">
                    <i class="ti ti-file-spreadsheet"></i> Export to Excel
                </a>
                <a href="{{ route('admin.consolidated-invoices.print', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-secondary w-100">
                    <i class="ti ti-printer"></i> Print Invoice
                </a>
            </div>
        </div>
        @endif

        <!-- Status Alert -->
        @if($consolidatedInvoice->isOverdue())
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle me-2"></i>
                <div>
                    <strong>Overdue Payment</strong><br>
                    <small>Due date was {{ $consolidatedInvoice->due_date->format('M j, Y') }}</small>
                </div>
            </div>
        </div>
        @elseif(($consolidatedInvoice->balance_due ?? 0) == 0)
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
        @if($consolidatedInvoice->customer)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>{{ $consolidatedInvoice->customer->name }}</strong>
                </div>
                @if($consolidatedInvoice->customer->email)
                <div class="mb-2">
                    <i class="ti ti-mail me-1"></i>{{ $consolidatedInvoice->customer->email }}
                </div>
                @endif
                @if($consolidatedInvoice->customer->phone)
                <div class="mb-2">
                    <i class="ti ti-phone me-1"></i>{{ $consolidatedInvoice->customer->phone }}
                </div>
                @endif
                @if($consolidatedInvoice->customer->address)
                <div class="mb-2">
                    <i class="ti ti-map-pin me-1"></i>{{ $consolidatedInvoice->customer->address }}
                </div>
                @endif
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
                    <p>Recording payment for Consolidated Invoice: <strong id="consolidatedNumber"></strong></p>
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
function recordPayment(consolidatedId, consolidatedNumber, balanceDue) {
    document.getElementById('consolidatedNumber').textContent = consolidatedNumber;
    document.getElementById('payment_amount').value = balanceDue.toFixed(2);
    document.getElementById('payment_amount').max = balanceDue;
    document.getElementById('maxAmount').textContent = balanceDue.toFixed(2);
    document.getElementById('paymentForm').action = `/admin/consolidated-invoices/${consolidatedId}/payment`;
    
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}
</script>
@endsection