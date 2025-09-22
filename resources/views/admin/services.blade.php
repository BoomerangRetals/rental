@extends('admin.app')

@section('page-title', 'Services')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Service Catalog</span>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add Service</a>
        </div>
        <div class="card-body">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price (AUD)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ number_format($service->price, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
