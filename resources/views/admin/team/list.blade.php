@extends('admin.app')

@section('page-title', 'Team Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Team Members</h5>
            <a href="{{ route('admin.team.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Add Team Member
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Visibility</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $team)
                        <tr>
                            <td>
                                @if($team->photo)
                                    <img src="{{ $team->photo }}" alt="{{ $team->name }}" class="rounded-circle" width="50" height="50">
                                @else
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bx bx-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $team->name }}</strong>
                                @if($team->is_chairman)
                                    <span class="badge bg-warning ms-2">Business Owner</span>
                                @endif
                            </td>
                            <td>{{ $team->business_title ?? $team->position }}</td>
                            <td>
                                @if($team->is_chairman)
                                    <span class="badge bg-warning">Business Owner</span>
                                @else
                                    <span class="badge bg-info">Team Member</span>
                                @endif
                            </td>
                            <td>{{ $team->email ?? 'N/A' }}</td>
                            <td>{{ $team->phone ?? 'N/A' }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input visibility-toggle" type="checkbox" 
                                           data-id="{{ $team->id }}" {{ $team->visibility ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.team.edit', $team->id) }}">
                                                <i class="bx bx-edit me-1"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.team.delete', $team->id) }}" method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to delete this team member?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bx bx-user-plus display-4 text-muted mb-2"></i>
                                    <p class="text-muted">No team members found.</p>
                                    <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add First Team Member</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle visibility toggle
    const visibilityToggles = document.querySelectorAll('.visibility-toggle');
    
    visibilityToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const teamId = this.dataset.id;
            const isVisible = this.checked;
            
            fetch(`/admin/team/${teamId}/toggle-visibility`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ visibility: isVisible })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    // Revert the toggle if the request failed
                    this.checked = !isVisible;
                    alert('Failed to update visibility');
                }
            })
            .catch(error => {
                // Revert the toggle if there was an error
                this.checked = !isVisible;
                console.error('Error:', error);
                alert('Error updating visibility');
            });
        });
    });
});
</script>
@endsection