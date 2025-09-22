@extends('admin.app')

@section('page-title', 'My Profile')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3 text-center">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/img/avatars/1.png') }}" alt="Profile Photo" class="rounded-circle" style="width:100px;height:100px;object-fit:cover;">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                        </div>
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
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
