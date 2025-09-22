@extends('admin.app')

@section('page-title', 'Consolidated Invoice Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">View consolidated invoice details and manage payments</p>
    </div>
    <div>
        <a href="{{ route('admin.consolidated-invoices.list') }}" class="btn btn-secondary me-2">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('admin.consolidated-invoices.print', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-primary">
            <i class="ti ti-printer"></i> Print
        </a>
    </div>
</div>

<div class="row">
    <!-- Consolidated Invoice Details -->
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Consolidated Invoice Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Consolidated Number</label>
                            <div class="fw-bold">{{ $consolidatedInvoice->consolidated_number }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Customer</label>
                            <div class="fw-bold">{{ $consolidatedInvoice->customer->name ?? 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Consolidated Date</label>
                            <div>{{ $consolidatedInvoice->consolidated_date ? $consolidatedInvoice->consolidated_date->format('M j, Y') : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Due Date</label>
                            <div>{{ $consolidatedInvoice->due_date ? $consolidatedInvoice->due_date->format('M j, Y') : 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <div>
                                @php
                                    $status = $consolidatedInvoice->payment_status ?? 'pending';
                                    $badgeClass = match($status) {
                                        'paid' => 'bg-success',
                                        'partial' => 'bg-warning',
                                        'pending' => 'bg-secondary',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Created</label>
                            <div>{{ $consolidatedInvoice->created_at ? $consolidatedInvoice->created_at->format('M j, Y g:i A') : 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                @if($consolidatedInvoice->notes)
                <div class="mt-3">
                    <label class="form-label text-muted">Notes</label>
                    <div class="p-3 bg-light rounded">{{ $consolidatedInvoice->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Included Invoices -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Included Invoices ({{ $consolidatedInvoice->invoices->count() }})</h5>
            </div>
            <div class="card-body">
                @if($consolidatedInvoice->invoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Date</th>
                                <th>Vehicle</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consolidatedInvoice->invoices as $invoice)
                            <tr>
                                <td>
                                    <strong>{{ $invoice->invoice_number }}</strong>
                                </td>
                                <td>
                                    {{ $invoice->invoice_date ? $invoice->invoice_date->format('M j, Y') : 'N/A' }}
                                </td>
                                <td>
                                    @if($invoice->customerVehicle)
                                        {{ $invoice->customerVehicle->year ?? '' }} 
                                        {{ $invoice->customerVehicle->make ?? '' }} 
                                        {{ $invoice->customerVehicle->model ?? '' }}
                                        <br>
                                        <small class="text-muted">{{ $invoice->customerVehicle->registration ?? 'No Rego' }}</small>
                                    @else
                                        <span class="text-muted">No vehicle</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>${{ number_format($invoice->pivot->amount ?? $invoice->total_amount ?? 0, 2) }}</strong>
                                </td>
                                <td>
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
                                </td>
                                <td>
                                    <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="ti ti-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="ti ti-file-x" style="font-size: 3rem; color: #ccc;"></i>
                    <h6 class="mt-2">No invoices included</h6>
                    <p class="text-muted">This consolidated invoice has no associated invoices.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Summary & Actions -->
    <div class="col-lg-4">
        <!-- Financial Summary -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Payment Summary</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Amount:</span>
                            <strong>${{ number_format($consolidatedInvoice->total_amount ?? 0, 2) }}</strong>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Amount Paid:</span>
                            <span class="text-success">${{ number_format($consolidatedInvoice->paid_amount ?? 0, 2) }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="my-2">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">Balance Due:</span>
                            <strong class="text-{{ ($consolidatedInvoice->balance_due ?? 0) > 0 ? 'danger' : 'success' }}">
                                ${{ number_format($consolidatedInvoice->balance_due ?? 0, 2) }}
                            </strong>
                        </div>
                    </div>
                </div>

                @if($consolidatedInvoice->payment_method)
                <div class="mt-3">
                    <label class="form-label text-muted">Payment Method</label>
                    <div>{{ ucfirst(str_replace('_', ' ', $consolidatedInvoice->payment_method)) }}</div>
                </div>
                @endif

                @if($consolidatedInvoice->paid_at)
                <div class="mt-3">
                    <label class="form-label text-muted">Paid Date</label>
                    <div>{{ $consolidatedInvoice->paid_at->format('M j, Y g:i A') }}</div>
                </div>
                @endif

                @if($consolidatedInvoice->payment_notes)
                <div class="mt-3">
                    <label class="form-label text-muted">Payment Notes</label>
                    <div class="p-2 bg-light rounded small">{{ $consolidatedInvoice->payment_notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        @if(($consolidatedInvoice->balance_due ?? 0) > 0)
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <button class="btn btn-success w-100 mb-2" onclick="recordPayment({{ $consolidatedInvoice->id }}, '{{ $consolidatedInvoice->consolidated_number }}', {{ $consolidatedInvoice->balance_due ?? 0 }})">
                    <i class="ti ti-credit-card"></i> Record Payment
                </button>
                <a href="{{ route('admin.consolidated-invoices.download', $consolidatedInvoice->id) }}" target="_blank" class="btn btn-outline-primary w-100">
                    <i class="ti ti-download"></i> Download PDF
                </a>
            </div>
        </div>
        @endif

        <!-- Overdue Warning -->
        @if($consolidatedInvoice->isOverdue())
        <div class="alert alert-warning">
            <i class="ti ti-alert-triangle"></i>
            <strong>Overdue!</strong><br>
            This consolidated invoice was due on {{ $consolidatedInvoice->due_date->format('M j, Y') }}.
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