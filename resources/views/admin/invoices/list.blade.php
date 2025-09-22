@extends('admin.app')

@section('page-title', 'Invoice Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Manage all customer invoices</p>
    </div>
    <div>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Create Invoice
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.invoices.list') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" name="search" id="search" class="form-control" 
                               placeholder="Invoice number or customer name..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Payment Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="partial" {{ request('status') === 'partial' ? 'selected' : '' }}>Partial</option>
                            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date_from" class="form-label">Date From</label>
                        <input type="date" name="date_from" id="date_from" class="form-control" 
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </div>
                @if(request('search') || request('status') || request('date_from'))
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="{{ route('admin.invoices.list') }}" class="btn btn-secondary btn-sm">Clear Filters</a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Invoice Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $invoices->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-file-blank fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Paid Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $invoices->where('payment_status', 'paid')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unpaid Invoices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $invoices->whereIn('payment_status', ['unpaid', 'partial'])->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-time fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($invoices->sum('total_amount'), 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bx bx-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoices Table -->
    <div class="card shadow mb-4" style="overflow: visible;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Invoices</h6>
        </div>
        <div class="card-body">
            @if($invoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Customer</th>
                                <th>Vehicle</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.invoices.view', $invoice->id) }}" class="text-decoration-none">
                                        {{ $invoice->invoice_number }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.view', $invoice->customer->id) }}" class="text-decoration-none">
                                        {{ $invoice->customer->name }}
                                    </a>
                                </td>
                                <td>{{ $invoice->customerVehicle->registration_number ?? 'N/A' }}</td>
                                <td>{{ $invoice->invoice_date->format('M j, Y') }}</td>
                                <td>{{ $invoice->due_date ? $invoice->due_date->format('M j, Y') : 'N/A' }}</td>
                                <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                <td>${{ number_format($invoice->paid_amount, 2) }}</td>
                                <td>${{ number_format($invoice->balance_due, 2) }}</td>
                                <td>
                                    @if($invoice->payment_status === 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($invoice->payment_status === 'partial')
                                        <span class="badge bg-warning">Partial</span>
                                    @else
                                        <span class="badge bg-danger">Unpaid</span>
                                    @endif
                                    
                                    @if($invoice->isOverdue())
                                        <br><span class="badge bg-danger mt-1">Overdue</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" style="z-index: 1050;">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.invoices.view', $invoice->id) }}">
                                                    <i class="bx bx-show me-1"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.invoices.print', $invoice->id) }}" target="_blank">
                                                    <i class="bx bx-printer me-1"></i> Print
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                                    <i class="bx bx-edit me-1"></i> Edit
                                                </a>
                                            </li>
                                            @if($invoice->payment_status !== 'paid')
                                            <li>
                                                <a class="dropdown-item" href="#" onclick="recordPayment({{ $invoice->id }}, '{{ $invoice->invoice_number }}', {{ $invoice->balance_due }})">
                                                    <i class="bx bx-dollar me-1"></i> Record Payment
                                                </a>
                                            </li>
                                            @endif
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" onclick="deleteInvoice({{ $invoice->id }}, '{{ $invoice->invoice_number }}')">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $invoices->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bx bx-file-blank" style="font-size: 3rem; color: #ccc;"></i>
                    <h5 class="mt-2">No invoices found</h5>
                    <p class="text-muted">Start by creating your first invoice.</p>
                    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Create Invoice
                    </a>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete Invoice <strong id="deleteInvoiceNumber"></strong>?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Invoice</button>
                </form>
            </div>
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

function deleteInvoice(invoiceId, invoiceNumber) {
    document.getElementById('deleteInvoiceNumber').textContent = invoiceNumber;
    document.getElementById('deleteForm').action = `/admin/invoices/${invoiceId}/delete`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection