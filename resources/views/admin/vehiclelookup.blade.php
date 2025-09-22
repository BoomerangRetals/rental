@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Customer Vehicles</h5>
                    <span class="badge bg-primary">{{ $vehicles->count() }} vehicles</span>
                </div>
                <div class="card-body" style="overflow: visible;">
                    <form method="GET" action="{{ route('admin.vehicle.lookup') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search by brand, model, rego, customer..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="bx bx-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="brand" class="form-control">
                                    <option value="">All Brands</option>
                                    @foreach($vehicles->pluck('brand')->unique()->sort() as $brand)
                                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                            @if(request('search') || request('brand'))
                            <div class="col-md-2">
                                <a href="{{ route('admin.vehicle.lookup') }}" class="btn btn-secondary">Clear</a>
                            </div>
                            @endif
                        </div>
                    </form>
                    @if($vehicles->count() > 0)
                        <div class="table-responsive" style="overflow: visible;">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vehicle</th>
                                        <th>Registration</th>
                                        <th>VIN</th>
                                        <th>Customer</th>
                                        <th>Contact</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicles as $vehicle)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ $vehicle->brand }} {{ $vehicle->model }}</strong>
                                                @if($vehicle->year)
                                                    <small class="text-muted d-block">{{ $vehicle->year }}</small>
                                                @endif
                                                @if($vehicle->colour)
                                                    <small class="text-muted d-block">{{ $vehicle->colour }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $vehicle->registration_number ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ Str::limit($vehicle->vin, 10) }}</small>
                                        </td>
                                        <td>
                                            @if($vehicle->customer)
                                                <div>
                                                    <strong>{{ $vehicle->customer->name }}</strong>
                                                </div>
                                            @else
                                                <span class="text-muted">No customer</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($vehicle->customer)
                                                <div>
                                                    <small class="text-muted d-block">{{ $vehicle->customer->email }}</small>
                                                    <small class="text-muted d-block">{{ $vehicle->customer->phone }}</small>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown position-static">
                                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1050;">
                                                    @if($vehicle->customer)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin.customers.vehicles', $vehicle->customer->id) }}">
                                                                <i class="bx bx-user me-1"></i> View Customer
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="bx bx-receipt me-1"></i> Create Invoice
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                    @endif
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.customers.vehicles.edit', [$vehicle->customer_id, $vehicle->id]) }}">
                                                            <i class="bx bx-edit me-1"></i> Edit Vehicle
                                                        </a>
                                                    </li>
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
                    @else
                        <div class="text-center py-4">
                            <i class="bx bx-car text-muted" style="font-size: 48px;"></i>
                            <p class="text-muted mt-2">No customer vehicles found.</p>
                            <a href="{{ route('admin.customers.list') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Add Vehicle to Customer
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
