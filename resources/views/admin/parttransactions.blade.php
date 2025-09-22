@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Transaction History: {{ $part->name }}</h5>
            <div class="card-body">
                <a href="{{ route('admin.parts.list') }}" class="btn btn-secondary mb-3">Back to Parts List</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Cost/Unit</th>
                            <th>Sale Price/Unit</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $t)
                        <tr>
                            <td>{{ $t->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ ucfirst($t->type) }}</td>
                            <td>{{ $t->quantity }}</td>
                            <td>{{ $t->cost ? number_format($t->cost,2) : '-' }}</td>
                            <td>{{ $t->price ? number_format($t->price,2) : '-' }}</td>
                            <td>{{ $t->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
