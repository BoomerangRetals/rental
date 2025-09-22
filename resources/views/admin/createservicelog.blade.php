@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Add Service Log</h5>
            <div class="card-body">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                <form method="POST" action="{{ route('admin.servicelog.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="vehicle_id" class="form-label">Vehicle</label>
                        <select class="form-select" id="vehicle_id" name="vehicle_id" required>
                            <option value="">Select Vehicle</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label">Service</label>
                        <select class="form-select" id="service_id" name="service_id" required>
                            <option value="">Select Service</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (AUD)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount (AUD)</label>
                        <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="cash">Cash</option>
                            <option value="abn">ABN</option>
                            <option value="payid">PayID</option>
                            <option value="bank">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Service Log</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script>
// AJAX load vehicles for selected customer
const customerSelect = document.getElementById('customer_id');
const vehicleSelect = document.getElementById('vehicle_id');
customerSelect.addEventListener('change', function() {
    const customerId = this.value;
    vehicleSelect.innerHTML = '<option value="">Select Vehicle</option>';
    if (customerId) {
        fetch(`/admin/ajax/customer/${customerId}/vehicles`)
            .then(res => res.json())
            .then(data => {
                data.forEach(function(vehicle) {
                    const opt = document.createElement('option');
                    opt.value = vehicle.id;
                    opt.text = `${vehicle.brand} ${vehicle.model} (${vehicle.year}) - ${vehicle.registration_number}`;
                    vehicleSelect.appendChild(opt);
                });
            });
    }
});
// Auto-fill price from service
const serviceSelect = document.getElementById('service_id');
const priceInput = document.getElementById('price');
serviceSelect.addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    priceInput.value = selected.getAttribute('data-price') || '';
});
</script>
@endsection
