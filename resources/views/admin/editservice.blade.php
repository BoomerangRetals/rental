@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Edit Service</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.services.update', $service->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Service Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (AUD)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $service->price) }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                    <a href="{{ route('admin.services.list') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
