@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Restock Part: {{ $part->name }}</h5>
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
                <form method="POST" action="{{ route('admin.parts.restock', $part->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity to Add</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Cost per Unit (AUD)</label>
                        <input type="number" step="0.01" class="form-control" id="cost" name="cost" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <input type="text" class="form-control" id="notes" name="notes">
                    </div>
                    <button type="submit" class="btn btn-primary">Restock</button>
                    <a href="{{ route('admin.parts.list') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
