@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Add Vehicle for {{ $customer->name }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customers.vehicles.store', $customer->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="registration_number" class="form-label">Registration Number</label>
                        <input type="text" class="form-control" id="registration_number" name="registration_number">
                    </div>
                    <div class="mb-3">
                        <label for="vin" class="form-label">VIN</label>
                        <input type="text" class="form-control" id="vin" name="vin" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Vehicle</button>
                    <a href="{{ route('admin.customers.vehicles', $customer->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
