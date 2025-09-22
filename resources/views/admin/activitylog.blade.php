@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">User Activity Log</h1>
    
    <div class="mb-4">
        <form method="GET" action="" class="row g-2 align-items-center">
            <div class="col-auto">
                <input type="text" name="search" class="form-control" placeholder="Search logs..." value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date/Time</th>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Model ID</th>
                    <th>Description</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $log->user ? ($log->user->given_name . ' ' . $log->user->surname) : 'System' }}</td>
                        <td>{{ ucfirst($log->action) }}</td>
                        <td>{{ $log->model_type }}</td>
                        <td>{{ $log->model_id }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->ip_address }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No activity logs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $logs->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(function() {
    let timer = null;
    $("input[name='search']").on('input', function() {
        clearTimeout(timer);
        const val = $(this).val();
        timer = setTimeout(function() {
            $.get(window.location.pathname, { search: val }, function(data) {
                const html = $(data).find('.table-responsive').html();
                $('.table-responsive').html(html);
                const pagination = $(data).find('.d-flex.justify-content-center').html();
                $('.d-flex.justify-content-center').html(pagination);
            });
        }, 300);
    });
});
</script>
@endpush
