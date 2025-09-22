@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Sell/Use Part: {{ $part->name }}</h5>
            <div class="card-body">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.parts.sell', $part->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="type" class="form-label">Transaction Type</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="sell">Sell</option>
                            <option value="use">Use (Internal)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="{{ $part->quantity }}" required>
                    </div>
                    <div class="mb-3" id="price-field">
                        <label for="price" class="form-label">Sale Price per Unit (AUD)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes">
                    </div>
                    <div class="mb-3">
                        <label for="staff_id" class="form-label">Staff</label>
                        <select class="form-select" id="staff_id" name="staff_id">
                            <option value="">Select Staff</option>
                            @foreach($staff as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.parts.list') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script>
// Hide price field if "Use" is selected
const typeSelect = document.getElementById('type');
const priceField = document.getElementById('price-field');
typeSelect.addEventListener('change', function() {
    if (this.value === 'use') {
        priceField.style.display = 'none';
    } else {
        priceField.style.display = '';
    }
});
typeSelect.dispatchEvent(new Event('change'));
</script>
@endsection
