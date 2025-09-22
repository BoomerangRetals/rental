@extends('admin.app')

@section('page-title', 'Customer Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Detailed view of customer information and activity</p>
    </div>
    <div>
        <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary me-2">
            <i class="ti ti-arrow-left"></i> Back to List
        </a>
        <div class="btn-group">
            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-outline-warning">
                <i class="ti ti-edit"></i> Edit
            </a>
            <a href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> New Invoice
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Full Name</label>
                            <div class="fw-bold h5">{{ $customer->name }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Email</label>
                            <div>
                                @if($customer->email)
                                    <a href="mailto:{{ $customer->email }}" class="text-primary">{{ $customer->email }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Phone Number</label>
                            <div>
                                @if($customer->phone)
                                    <a href="tel:{{ $customer->phone }}" class="text-primary">{{ $customer->phone }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Address</label>
                            <div>{{ $customer->address ?? 'Not provided' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Customer Since</label>
                            <div>{{ $customer->created_at ? $customer->created_at->format('M j, Y') : 'N/A' }}</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">Last Updated</label>
                            <div>{{ $customer->updated_at ? $customer->updated_at->format('M j, Y g:i A') : 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicles -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Customer Vehicles
                    <span class="badge bg-primary ms-2">{{ $totalVehicles }}</span>
                </h5>
                <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="ti ti-plus"></i> Add Vehicle
                </a>
            </div>
            <div class="card-body">
                @if($customer->vehicles && $customer->vehicles->count() > 0)
                <div class="row">
                    @foreach($customer->vehicles as $vehicle)
                    <div class="col-md-6 mb-3">
                        <div class="card border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">
                                            {{ $vehicle->year ?? '' }} {{ $vehicle->make ?? '' }} {{ $vehicle->model ?? '' }}
                                        </h6>
                                        <div class="text-muted small">
                                            <div><strong>Registration:</strong> {{ $vehicle->registration ?? 'Not provided' }}</div>
                                            @if($vehicle->vin)
                                            <div><strong>VIN:</strong> {{ $vehicle->vin }}</div>
                                            @endif
                                            @if($vehicle->color)
                                            <div><strong>Color:</strong> {{ $vehicle->color }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.customers.vehicles.edit', [$customer->id, $vehicle->id]) }}">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}&vehicle_id={{ $vehicle->id }}">
                                                    <i class="ti ti-file-plus"></i> Create Invoice
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="ti ti-car" style="font-size: 3rem; color: #ccc;"></i>
                    <h6 class="mt-2">No Vehicles</h6>
                    <p class="text-muted">This customer hasn't added any vehicles yet.</p>
                    <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Add First Vehicle
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Invoices -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Recent Invoices
                    <span class="badge bg-info ms-2">{{ $recentInvoices->count() }}</span>
                </h5>
                <a href="{{ route('admin.invoices.customer', $customer->id) }}" class="btn btn-sm btn-outline-primary">
                    <i class="ti ti-list"></i> View All
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentInvoices->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice #</th>
                                <th>Date</th>
                                <th>Vehicle</th>
                                <th class="text-end">Amount</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentInvoices as $invoice)
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
                                        <br><small class="text-muted">{{ $invoice->customerVehicle->registration ?? 'No Rego' }}</small>
                                    @else
                                        <span class="text-muted">No vehicle</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <strong>${{ number_format($invoice->total_amount ?? 0, 2) }}</strong>
                                </td>
                                <td>
                                    @php
                                        $status = $invoice->payment_status ?? 'unpaid';
                                        $badgeClass = match($status) {
                                            'paid' => 'bg-success',
                                            'partial' => 'bg-warning',
                                            'unpaid' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @if($invoice->payment_status !== 'paid')
                                        <button class="btn btn-sm btn-outline-success" onclick="recordPayment({{ $invoice->id }}, '{{ $invoice->invoice_number }}', {{ $invoice->balance_due ?? 0 }})">
                                            <i class="ti ti-credit-card"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="ti ti-file-x" style="font-size: 3rem; color: #ccc;"></i>
                    <h6 class="mt-2">No Invoices</h6>
                    <p class="text-muted">This customer doesn't have any invoices yet.</p>
                    <a href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Create First Invoice
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Quick Stats -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer Statistics</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-primary">{{ $totalVehicles }}</div>
                            <div class="text-muted small">Vehicles</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-info">{{ $totalInvoices }}</div>
                            <div class="text-muted small">Invoices</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="my-2">
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Total Paid:</span>
                            <strong class="text-success">${{ number_format($totalPaid ?? 0, 2) }}</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Outstanding:</span>
                            <strong class="text-{{ ($unpaidAmount ?? 0) > 0 ? 'danger' : 'success' }}">
                                ${{ number_format($unpaidAmount ?? 0, 2) }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary w-100 mb-3">
                    <i class="ti ti-file-plus"></i> Create Invoice
                </a>
                <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-outline-primary w-100 mb-3">
                    <i class="ti ti-car-plus"></i> Add Vehicle
                </a>
                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-outline-warning w-100 mb-2">
                    <i class="ti ti-edit"></i> Edit Customer
                </a>
                <a href="{{ route('admin.invoices.customer', $customer->id) }}" class="btn btn-outline-info w-100">
                    <i class="ti ti-list"></i> View All Invoices
                </a>
            </div>
        </div>

        <!-- Outstanding Balance Alert -->
        @if(($unpaidAmount ?? 0) > 0)
        <div class="alert alert-warning">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle me-2"></i>
                <div>
                    <strong>Outstanding Balance</strong><br>
                    <small>This customer has ${{ number_format($unpaidAmount, 2) }} in unpaid invoices</small>
                </div>
            </div>
        </div>
        @endif

        <!-- Contact Information -->
        @if($customer->email || $customer->phone)
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Contact Customer</h5>
            </div>
            <div class="card-body">
                @if($customer->email)
                <a href="mailto:{{ $customer->email }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="ti ti-mail"></i> Send Email
                </a>
                @endif
                @if($customer->phone)
                <a href="tel:{{ $customer->phone }}" class="btn btn-outline-success w-100">
                    <i class="ti ti-phone"></i> Call Customer
                </a>
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