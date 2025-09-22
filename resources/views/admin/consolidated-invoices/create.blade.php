@extends('admin.app')

@section('page-title', 'Create Consolidated Invoice')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Create Consolidated Invoice</h4>
                <a href="{{ route('admin.consolidated-invoices.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.consolidated-invoices.store') }}" method="POST">
                        @csrf

                        <!-- Customer Selection -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="customer_id" class="form-label">Select Customer *</label>
                                <select name="customer_id" id="customer_id" class="form-select" required>
                                    <option value="">Choose a customer...</option>
                                    @foreach($customers as $cust)
                                        <option value="{{ $cust->id }}" {{ old('customer_id', $customer?->id) == $cust->id ? 'selected' : '' }}>
                                            {{ $cust->name }} {{ $cust->email ? '(' . $cust->email . ')' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" 
                                       value="{{ old('due_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="button" class="btn btn-info d-block" onclick="loadUnpaidInvoices()">
                                    <i class="fas fa-search"></i> Load Unpaid Invoices
                                </button>
                            </div>
                        </div>

                        <!-- Unpaid Invoices Section -->
                        <div id="unpaid-invoices-section" style="{{ $unpaidInvoices->count() > 0 ? '' : 'display: none;' }}">
                            <h5 class="mb-3">Unpaid Invoices</h5>
                            
                            @if($unpaidInvoices->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th width="50">
                                                    <input type="checkbox" id="select-all">
                                                </th>
                                                <th>Invoice #</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Total Amount</th>
                                                <th>Balance Due</th>
                                                <th>Status</th>
                                                <th>Days Overdue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($unpaidInvoices as $invoice)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="selected_invoices[]" 
                                                               value="{{ $invoice->id }}" class="invoice-checkbox">
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.invoices.view', $invoice->id) }}" 
                                                           target="_blank" class="text-decoration-none">
                                                            {{ $invoice->invoice_number }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $invoice->invoice_date->format('M j, Y') }}</td>
                                                    <td>
                                                        @if($invoice->due_date)
                                                            {{ $invoice->due_date->format('M j, Y') }}
                                                        @else
                                                            <span class="text-muted">No due date</span>
                                                        @endif
                                                    </td>
                                                    <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                                    <td>
                                                        <strong>${{ number_format($invoice->balance_due, 2) }}</strong>
                                                    </td>
                                                    <td>
                                                        @if($invoice->payment_status === 'unpaid')
                                                            <span class="badge bg-danger">Unpaid</span>
                                                        @else
                                                            <span class="badge bg-warning">Partial</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($invoice->due_date && $invoice->due_date->isPast())
                                                            <span class="text-danger fw-bold">
                                                                {{ $invoice->due_date->diffInDays(now()) }} days
                                                            </span>
                                                        @else
                                                            <span class="text-muted">Not overdue</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-info">
                                                <td colspan="5"><strong>Total Selected:</strong></td>
                                                <td><strong id="selected-total">$0.00</strong></td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    @if($customer)
                                        No unpaid invoices found for {{ $customer->name }}.
                                    @else
                                        Please select a customer to view their unpaid invoices.
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Notes Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <label for="notes" class="form-label">Notes (Optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" 
                                          placeholder="Add any notes for this consolidated invoice...">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.consolidated-invoices.list') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="create-btn" disabled>
                                        <i class="fas fa-plus"></i> Create Consolidated Invoice
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const invoiceCheckboxes = document.querySelectorAll('.invoice-checkbox');
    const createBtn = document.getElementById('create-btn');
    const selectedTotal = document.getElementById('selected-total');

    // Select/Deselect all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            invoiceCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedTotal();
            updateCreateButton();
        });
    }

    // Individual checkbox handling
    invoiceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllState();
            updateSelectedTotal();
            updateCreateButton();
        });
    });

    function updateSelectAllState() {
        const checkedCount = document.querySelectorAll('.invoice-checkbox:checked').length;
        if (selectAllCheckbox) {
            selectAllCheckbox.checked = checkedCount === invoiceCheckboxes.length && checkedCount > 0;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < invoiceCheckboxes.length;
        }
    }

    function updateSelectedTotal() {
        let total = 0;
        document.querySelectorAll('.invoice-checkbox:checked').forEach(checkbox => {
            const row = checkbox.closest('tr');
            const balanceCell = row.querySelector('td:nth-child(6) strong');
            if (balanceCell) {
                const amount = parseFloat(balanceCell.textContent.replace('$', '').replace(',', ''));
                total += amount;
            }
        });
        
        if (selectedTotal) {
            selectedTotal.textContent = '$' + total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
    }

    function updateCreateButton() {
        const checkedCount = document.querySelectorAll('.invoice-checkbox:checked').length;
        if (createBtn) {
            createBtn.disabled = checkedCount === 0;
        }
    }

    // Initialize states
    updateSelectAllState();
    updateSelectedTotal();
    updateCreateButton();
});

function loadUnpaidInvoices() {
    const customerId = document.getElementById('customer_id').value;
    if (!customerId) {
        alert('Please select a customer first.');
        return;
    }
    
    // Redirect to load unpaid invoices for the selected customer
    window.location.href = "{{ route('admin.consolidated-invoices.create') }}" + "?customer_id=" + customerId;
}

// Auto-load invoices when customer is selected via URL parameter
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const customerId = urlParams.get('customer_id');
    
    if (customerId && !{{ $unpaidInvoices->count() > 0 ? 'true' : 'false' }}) {
        loadUnpaidInvoices();
    }
});
</script>
@endsection