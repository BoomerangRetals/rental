@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Edit Vehicle for {{ $customer->name }}</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customers.vehicles.update', [$customer->id, $vehicle->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $vehicle->model) }}" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input type="number" class="form-control" id="year" name="year" min="1900" max="{{ date('Y') + 1 }}" value="{{ old('year', $vehicle->year) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="colour" class="form-label">Colour</label>
                                <input type="text" class="form-control" id="colour" name="colour" value="{{ old('colour', $vehicle->colour) }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number" name="registration_number" value="{{ old('registration_number', $vehicle->registration_number) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="vin" class="form-label">VIN</label>
                                <input type="text" class="form-control" id="vin" name="vin" value="{{ old('vin', $vehicle->vin) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select class="form-control" id="transmission" name="transmission">
                                    <option value="">Select Transmission</option>
                                    <option value="Manual" {{ old('transmission', $vehicle->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Automatic" {{ old('transmission', $vehicle->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="CVT" {{ old('transmission', $vehicle->transmission) == 'CVT' ? 'selected' : '' }}>CVT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fuel" class="form-label">Fuel Type</label>
                                <select class="form-control" id="fuel" name="fuel">
                                    <option value="">Select Fuel Type</option>
                                    <option value="Petrol" {{ old('fuel', $vehicle->fuel) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="Diesel" {{ old('fuel', $vehicle->fuel) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="Electric" {{ old('fuel', $vehicle->fuel) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                    <option value="Hybrid" {{ old('fuel', $vehicle->fuel) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="body_type" class="form-label">Body Type</label>
                                <input type="text" class="form-control" id="body_type" name="body_type" value="{{ old('body_type', $vehicle->body_type) }}" placeholder="e.g., Sedan, SUV, Hatchback">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="engine_no" class="form-label">Engine Number</label>
                                <input type="text" class="form-control" id="engine_no" name="engine_no" value="{{ old('engine_no', $vehicle->engine_no) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="odometer_reading" class="form-label">Odometer Reading (km)</label>
                        <input type="number" class="form-control" id="odometer_reading" name="odometer_reading" min="0" value="{{ old('odometer_reading', $vehicle->odometer_reading) }}">
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" maxlength="1000">{{ old('notes', $vehicle->notes) }}</textarea>
                        <small class="text-muted">Optional notes about this vehicle</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                    <a href="{{ route('admin.customers.vehicles', $customer->id) }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
