@extends('admin.app')

@section('title', 'Customer Profile - ' . $customer->name)

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Profile</h1>
        <div>
            <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary me-2">
                <i class="bx bx-arrow-back"></i> Back to Customers
            </a>
            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-primary">
                <i class="bx bx-edit"></i> Edit Customer
            </a>
        </div>
    </div>

    <!-- Customer Information Card -->
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <h4 class="mt-3 mb-1">{{ $customer->name }}</h4>
                        <p class="text-muted">Customer since {{ $customer->created_at->format('M Y') }}</p>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Email:</strong></div>
                        <div class="col-sm-8">{{ $customer->email ?: 'Not provided' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Phone:</strong></div>
                        <div class="col-sm-8">{{ $customer->phone ?: 'Not provided' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Address:</strong></div>
                        <div class="col-sm-8">{{ $customer->address ?: 'Not provided' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>License:</strong></div>
                        <div class="col-sm-8">{{ $customer->license ?: 'Not provided' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4"><strong>Status:</strong></div>
                        <div class="col-sm-8">
                            <span class="badge bg-{{ $customer->active ? 'success' : 'danger' }}">
                                {{ $customer->active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <h4 class="text-primary mb-1">{{ $totalVehicles }}</h4>
                                <small class="text-muted">Vehicles</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h4 class="text-success mb-1">{{ $totalInvoices }}</h4>
                                <small class="text-muted">Invoices</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <h4 class="text-info mb-1">${{ number_format($totalPaid, 2) }}</h4>
                            <small class="text-muted">Total Paid</small>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h5 class="text-{{ $unpaidAmount > 0 ? 'danger' : 'success' }} mb-1">
                            ${{ number_format($unpaidAmount, 2) }}
                        </h5>
                        <small class="text-muted">Outstanding Balance</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <!-- Action Buttons -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('admin.customers.vehicles', $customer->id) }}" class="btn btn-outline-primary w-100">
                                <i class="bx bx-car d-block mb-1" style="font-size: 1.5rem;"></i>
                                View All Vehicles
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-outline-success w-100">
                                <i class="bx bx-plus-circle d-block mb-1" style="font-size: 1.5rem;"></i>
                                Add New Vehicle
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}" class="btn btn-outline-info w-100">
                                <i class="bx bx-receipt d-block mb-1" style="font-size: 1.5rem;"></i>
                                Create Invoice
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('admin.invoices.customer', $customer->id) }}" class="btn btn-outline-primary w-100">
                                <i class="bx bx-file-blank d-block mb-1" style="font-size: 1.5rem;"></i>
                                View All Invoices
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-outline-warning w-100">
                                <i class="bx bx-edit d-block mb-1" style="font-size: 1.5rem;"></i>
                                Edit Customer
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <button class="btn btn-outline-secondary w-100" onclick="window.print()">
                                <i class="bx bx-printer d-block mb-1" style="font-size: 1.5rem;"></i>
                                Print Profile
                            </button>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <button class="btn btn-outline-danger w-100 delete-customer" 
                                    data-customer-id="{{ $customer->id }}" 
                                    data-customer-name="{{ $customer->name }}">
                                <i class="bx bx-trash d-block mb-1" style="font-size: 1.5rem;"></i>
                                Delete Customer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Vehicles -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Vehicles</h6>
                    <a href="{{ route('admin.customers.vehicles', $customer->id) }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($customer->vehicles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Registration</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Year</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer->vehicles->take(5) as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->registration_number }}</td>
                                        <td>{{ $vehicle->brand }}</td>
                                        <td>{{ $vehicle->model }}</td>
                                        <td>{{ $vehicle->year }}</td>
                                        <td>
                                            <span class="badge bg-{{ $vehicle->active ? 'success' : 'secondary' }}">
                                                {{ $vehicle->active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($customer->vehicles->count() > 5)
                            <p class="text-muted text-center">Showing 5 of {{ $customer->vehicles->count() }} vehicles</p>
                        @endif
                    @else
                        <p class="text-muted text-center py-4">No vehicles registered for this customer.</p>
                        <div class="text-center">
                            <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> Add First Vehicle
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Invoices -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Invoices</h6>
                    <a href="{{ route('admin.invoices.customer', $customer->id) }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentInvoices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                                    @foreach($recentInvoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_date->format('M j, Y') }}</td>
                                        <td>{{ $invoice->customerVehicle->registration_number ?? 'N/A' }}</td>
                                        <td>${{ number_format($invoice->total_amount, 2) }}</td>
                                        <td>
                                            @if($invoice->payment_status === 'paid')
                                                <span class="badge bg-success">Paid</span>
                                            @elseif($invoice->payment_status === 'partial')
                                                <span class="badge bg-warning">Partial</span>
                                            @else
                                                <span class="badge bg-danger">Unpaid</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.invoices.view', $invoice->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="{{ route('admin.invoices.print', $invoice->id) }}" class="btn btn-sm btn-outline-secondary" target="_blank">Print</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">No invoices found for this customer.</p>
                        <div class="text-center">
                            <a href="{{ route('admin.invoices.create') }}?customer_id={{ $customer->id }}" class="btn btn-primary">
                                <i class="bx bx-plus"></i> Create First Invoice
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete customer <strong id="customerName"></strong>?</p>
                <p class="text-muted">This action cannot be undone and will remove all associated vehicles and service records.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete customer modal
    document.querySelectorAll('.delete-customer').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const customerId = this.getAttribute('data-customer-id');
            const customerName = this.getAttribute('data-customer-name');
            
            document.getElementById('customerName').textContent = customerName;
            document.getElementById('deleteForm').action = `/admin/customers/${customerId}/delete`;
            
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });
    });
});
</script>

@push('styles')
<style>
@media print {
    .btn, .card-header .btn, .modal, .navbar, .sidebar {
        display: none !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
}
</style>
@endpush
@endsection