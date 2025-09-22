@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Vehicles for {{ $customer->name }}</span>
            <div>
                <a href="{{ route('admin.customers.vehicles.add', $customer->id) }}" class="btn btn-primary me-2">Add Vehicle</a>
                <a href="{{ route('admin.customers.list') }}" class="btn btn-secondary">Back to Customers</a>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.customers.vehicles', $customer->id) }}" class="mb-3">
                <div class="input-group" style="max-width: 350px;">
                    <input type="text" name="search" class="form-control" placeholder="Search vehicles..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Registration</th>
                        <th>VIN</th>
                        <th width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td>{{ $vehicle->brand }}</td>
                        <td>{{ $vehicle->model }}</td>
                        <td>{{ $vehicle->year }}</td>
                        <td>{{ $vehicle->registration_number }}</td>
                        <td>{{ $vehicle->vin }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1050;">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.customers.vehicles.edit', [$customer->id, $vehicle->id]) }}">
                                            <i class="bx bx-edit me-1"></i> Edit Vehicle
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bx bx-receipt me-1"></i> Create Invoice
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger delete-vehicle" href="#" 
                                           data-vehicle-id="{{ $vehicle->id }}" 
                                           data-vehicle-name="{{ $vehicle->brand }} {{ $vehicle->model }}">
                                            <i class="bx bx-trash me-1"></i> Delete Vehicle
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
                <p>Are you sure you want to delete <strong id="vehicleName"></strong>?</p>
                <p class="text-muted">This action cannot be undone and will remove all associated service records.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Vehicle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.delete-vehicle').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const vehicleId = this.getAttribute('data-vehicle-id');
            const vehicleName = this.getAttribute('data-vehicle-name');
            
            document.getElementById('vehicleName').textContent = vehicleName;
            document.getElementById('deleteForm').action = `/admin/vehicles/${vehicleId}/delete`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });
});
</script>
@endsection
