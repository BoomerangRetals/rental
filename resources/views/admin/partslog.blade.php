@extends('admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Parts Log History</span>
            <form method="get" class="d-flex align-items-center">
                <label class="me-2">View:</label>
                <select name="range" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    <option value="daily" {{ $range=='daily' ? 'selected' : '' }}>Today</option>
                    <option value="weekly" {{ $range=='weekly' ? 'selected' : '' }}>This Week</option>
                    <option value="monthly" {{ $range=='monthly' ? 'selected' : '' }}>This Month</option>
                </select>
            </form>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <input type="text" id="parts-log-search" class="form-control" placeholder="Search logs..." />
            </div>
            <table class="table table-bordered table-striped" id="parts-log-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Part Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Cost/Unit</th>
                        <th>Receive Amount</th>
                        <th>Seller/Staff</th>
                        <th>Operator</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $log->part->name ?? '-' }}</td>
                        <td>{{ ucfirst($log->type) }}</td>
                        <td>{{ $log->quantity }}</td>
                        <td>{{ $log->cost ? number_format($log->cost,2) : '-' }}</td>
                        <td>{{ $log->price ? number_format($log->price,2) : '-' }}</td>
                        <td>{{ $log->staff->name ?? '-' }}</td>
                        <td>{{ $log->user->name ?? '-' }}</td>
                        <td>{{ $log->notes }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script>
document.getElementById('parts-log-search').addEventListener('keyup', function() {
    var value = this.value.toLowerCase();
    var rows = document.querySelectorAll('#parts-log-table tbody tr');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.indexOf(value) > -1 ? '' : 'none';
    });
});
</script>
@endsection
