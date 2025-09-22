@extends('admin.app')

@section('page-title', 'Consolidated Invoices')

@section('content')
<style>
.table-responsive {
    overflow: visible !important;
}
.dropdown-menu {
    z-index: 1050 !important;
    position: absolute !important;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
.table td {
    position: relative;
}
.table .dropdown {
    position: static;
}
.dropdown-toggle::after {
    display: none;
}
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Manage consolidated invoices for multiple customers</p>
    </div>
    <div>
        <a href="{{ route('admin.consolidated-invoices.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Create Consolidated Invoice
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Consolidated Invoices</h5>
            </div>
            <div class="card-body">
                @if(isset($consolidatedInvoices) && $consolidatedInvoices->count() > 0)
                <div class="table-responsive" style="overflow: visible;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Consolidated #</th>
                                <th>Customer</th>
                                <th>Invoice Count</th>
                                <th>Items Summary</th>
                                <th>Total Amount</th>
                                <th>Amount Paid</th>
                                <th>Balance Due</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consolidatedInvoices as $consolidated)
                            <tr>
                                <td>
                                    <strong>{{ $consolidated->consolidated_number }}</strong>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-wrapper">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($consolidated->customer_name ?? 'N/A', 0, 2)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $consolidated->customer_name ?? 'N/A' }}</h6>
                                            <small class="text-muted">ID: {{ $consolidated->customer_id ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $consolidated->invoices_count ?? 0 }} invoices</span>
                                </td>
                                <td>
                                    @php
                                        $totalItems = 0;
                                        $itemTypes = [];
                                        if ($consolidated->invoices) {
                                            foreach ($consolidated->invoices as $invoice) {
                                                if ($invoice->items) {
                                                    foreach ($invoice->items as $item) {
                                                        $totalItems += $item->quantity ?? 0;
                                                        $desc = trim($item->description ?? '');
                                                        if ($desc && !in_array($desc, $itemTypes) && count($itemTypes) < 3) {
                                                            $itemTypes[] = $desc;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    @if($totalItems > 0)
                                        <div>
                                            <small class="text-muted">{{ $totalItems }} total items</small>
                                            @if(count($itemTypes) > 0)
                                                <br>
                                                <span class="badge bg-light text-dark">{{ implode(', ', array_slice($itemTypes, 0, 2)) }}{{ count($itemTypes) > 2 ? '...' : '' }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <small class="text-muted">No items</small>
                                    @endif
                                </td>
                                <td>
                                    <strong>${{ number_format($consolidated->total_amount ?? 0, 2) }}</strong>
                                </td>
                                <td>
                                    <span class="text-success">${{ number_format($consolidated->amount_paid ?? 0, 2) }}</span>
                                </td>
                                <td>
                                    <span class="text-{{ ($consolidated->balance_due ?? 0) > 0 ? 'danger' : 'success' }}">
                                        ${{ number_format($consolidated->balance_due ?? 0, 2) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $status = $consolidated->payment_status ?? 'unpaid';
                                        $badgeClass = match($status) {
                                            'paid' => 'bg-success',
                                            'partial' => 'bg-warning',
                                            'unpaid' => 'bg-danger',
                                            'pending' => 'bg-secondary',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $consolidated->created_at ? $consolidated->created_at->format('M j, Y') : 'N/A' }}
                                        <br>
                                        {{ $consolidated->created_at ? $consolidated->created_at->format('g:i A') : '' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary" type="button" 
                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                id="dropdownMenuButton{{ $consolidated->id }}">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" 
                                            aria-labelledby="dropdownMenuButton{{ $consolidated->id }}">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.consolidated-invoices.show', $consolidated->id ?? 0) }}">
                                                    <i class="ti ti-eye me-2"></i>View Details
                                                </a>
                                            </li>
                                            @if(($consolidated->balance_due ?? 0) > 0)
                                            <li>
                                                <a class="dropdown-item" href="#" 
                                                   data-payment-id="{{ $consolidated->id ?? 0 }}" 
                                                   data-payment-number="{{ $consolidated->consolidated_number ?? '' }}" 
                                                   data-payment-amount="{{ number_format($consolidated->balance_due ?? 0, 2, '.', '') }}"
                                                   onclick="recordPayment(this.dataset.paymentId, this.dataset.paymentNumber, parseFloat(this.dataset.paymentAmount))">
                                                    <i class="ti ti-credit-card me-2"></i>Record Payment
                                                </a>
                                            </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.consolidated-invoices.download', $consolidated->id ?? 0) }}" target="_blank">
                                                    <i class="ti ti-download me-2"></i>Download PDF
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.consolidated-invoices.excel', $consolidated->id ?? 0) }}" target="_blank">
                                                    <i class="ti ti-file-spreadsheet me-2"></i>Export to Excel
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.consolidated-invoices.print', $consolidated->id ?? 0) }}" target="_blank">
                                                    <i class="ti ti-printer me-2"></i>Print Invoice
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" 
                                                   data-delete-id="{{ $consolidated->id ?? 0 }}" 
                                                   data-delete-number="{{ $consolidated->consolidated_number ?? '' }}"
                                                   onclick="deleteConsolidated(this.dataset.deleteId, this.dataset.deleteNumber)">
                                                    <i class="ti ti-trash me-2"></i>Delete
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
                @if(isset($consolidatedInvoices) && method_exists($consolidatedInvoices, 'links'))
                <div class="d-flex justify-content-center">
                    {{ $consolidatedInvoices->appends(request()->query())->links() }}
                </div>
                @endif
                @else
                <div class="text-center py-4">
                    <i class="ti ti-file-stack" style="font-size: 3rem; color: #ccc;"></i>
                    <h5 class="mt-2">No consolidated invoices found</h5>
                    <p class="text-muted">Create your first consolidated invoice to combine multiple customer invoices.</p>
                    <a href="{{ route('admin.consolidated-invoices.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Create Consolidated Invoice
                    </a>
                </div>
                @endif
            </div>
        </div>
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete Consolidated Invoice <strong id="deleteConsolidatedNumber"></strong>?</p>
                <p class="text-muted">This action cannot be undone and will affect all associated invoices.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Consolidated Invoice</button>
                </form>
            </div>
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

function deleteConsolidated(consolidatedId, consolidatedNumber) {
    document.getElementById('deleteConsolidatedNumber').textContent = consolidatedNumber;
    document.getElementById('deleteForm').action = `/admin/consolidated-invoices/${consolidatedId}/delete`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection