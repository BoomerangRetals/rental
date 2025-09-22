@extends('admin.app')

@section('page-title', 'Business Owner Info')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Business Owner Information</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bx bx-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bx bx-error-circle me-2"></i>
                            <strong>There were some problems with your input:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admin.owner.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Full Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $owner->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="business_title">Business Title</label>
                            <input type="text" class="form-control @error('business_title') is-invalid @enderror" id="business_title" name="business_title" value="{{ old('business_title', $owner->business_title ?? '') }}" placeholder="e.g., Founder & CEO, Business Owner">
                            @error('business_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="position">Position *</label>
                            <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $owner->position ?? '') }}" required>
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="photo">Photo</label>
                            @if(!empty($owner->photo))
                                <div class="mb-2">
                                    <img src="{{ $owner->photo }}" alt="{{ $owner->name }}" class="rounded" width="100" height="100">
                                    <small class="d-block text-muted">Current photo</small>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                            <div class="form-text">Upload a professional photo (max 2MB, formats: JPEG, PNG, JPG, GIF)</div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="company_message">Company Message</label>
                            <textarea class="form-control @error('company_message') is-invalid @enderror" id="company_message" name="company_message" rows="3" placeholder="Personal message from the business owner to customers...">{{ old('company_message', $owner->company_message ?? '') }}</textarea>
                            @error('company_message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="vision_statement">Vision Statement</label>
                            <textarea class="form-control @error('vision_statement') is-invalid @enderror" id="vision_statement" name="vision_statement" rows="3" placeholder="Company's vision for the future...">{{ old('vision_statement', $owner->vision_statement ?? '') }}</textarea>
                            @error('vision_statement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="thoughts">Philosophy & Thoughts</label>
                            <textarea class="form-control @error('thoughts') is-invalid @enderror" id="thoughts" name="thoughts" rows="3" placeholder="Business philosophy and core beliefs...">{{ old('thoughts', $owner->thoughts ?? '') }}</textarea>
                            @error('thoughts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="bio">Bio/Description</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3" placeholder="Brief description about the owner...">{{ old('bio', $owner->bio ?? '') }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="facebook">Facebook URL</label>
                                <input type="url" class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook" value="{{ old('facebook', $owner->facebook ?? '') }}" placeholder="https://facebook.com/profile">
                                @error('facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="instagram">Instagram URL</label>
                                <input type="url" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{ old('instagram', $owner->instagram ?? '') }}" placeholder="https://instagram.com/profile">
                                @error('instagram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="snap">Snapchat URL</label>
                                <input type="url" class="form-control @error('snap') is-invalid @enderror" id="snap" name="snap" value="{{ old('snap', $owner->snap ?? '') }}" placeholder="https://snapchat.com/profile">
                                @error('snap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="visibility" name="visibility" {{ old('visibility', $owner->visibility ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="visibility">
                                <strong>Visible on Website</strong>
                                <div class="form-text">Show the business owner on the about page</div>
                            </label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Save Owner Info
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
