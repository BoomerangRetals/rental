@extends('admin.app')

@section('page-title', 'Customers')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Customer List</span>
            <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Add Customer</a>
        </div>
        <div class="card-body">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <form method="GET" action="{{ route('admin.customers.list') }}" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <input type="text" name="search" class="form-control" placeholder="Search customers..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" style="z-index: 1050;">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.view', $customer->id) }}">
                                            <i class="bx bx-user me-1"></i> View Customer
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.edit', $customer->id) }}">
                                            <i class="bx bx-edit me-1"></i> Edit Customer
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.vehicles', $customer->id) }}">
                                            <i class="bx bx-car me-1"></i> View Vehicles
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.vehicles.add', $customer->id) }}">
                                            <i class="bx bx-plus me-1"></i> Add Vehicle
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger delete-customer" href="#" 
                                           data-customer-id="{{ $customer->id }}" 
                                           data-customer-name="{{ $customer->name }}">
                                            <i class="bx bx-trash me-1"></i> Delete Customer
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
    document.querySelectorAll('.delete-customer').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const customerId = this.getAttribute('data-customer-id');
            const customerName = this.getAttribute('data-customer-name');
            
            document.getElementById('customerName').textContent = customerName;
            document.getElementById('deleteForm').action = `/admin/customers/${customerId}/delete`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
});
</script>
@endsection
