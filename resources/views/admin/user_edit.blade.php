@extends('admin.app')

@section('page-title', 'Edit User')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="given_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="given_name" name="given_name" value="{{ old('given_name', $user->given_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="surname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $user->surname) }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="super" @if($user->role=='super') selected @endif>Super</option>
                                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                                <option value="staff" @if($user->role=='staff') selected @endif>Staff</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
