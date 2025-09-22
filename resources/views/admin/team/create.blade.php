@extends('admin.app')

@section('page-title', request('owner') ? 'Add Business Owner' : 'Add Team Member')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ request('owner') ? 'Add Business Owner' : 'Add New Team Member' }}</h5>
                    <a href="{{ route('admin.team.list') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Back to List
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="position">Position *</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" 
                                       id="position" name="position" value="{{ old('position') }}" 
                                       placeholder="e.g., Senior Mechanic, Manager" required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="photo">Photo *</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" 
                                   id="photo" name="photo" accept="image/*" required>
                            <div class="form-text">Upload a professional photo (max 2MB, formats: JPEG, PNG, JPG, GIF)</div>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="bio">Bio/Description</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      id="bio" name="bio" rows="4" 
                                      placeholder="Brief description about the team member...">{{ old('bio') }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label" for="facebook">Facebook URL</label>
                                <input type="url" class="form-control @error('facebook') is-invalid @enderror" 
                                       id="facebook" name="facebook" value="{{ old('facebook') }}" 
                                       placeholder="https://facebook.com/profile">
                                @error('facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="instagram">Instagram URL</label>
                                <input type="url" class="form-control @error('instagram') is-invalid @enderror" 
                                       id="instagram" name="instagram" value="{{ old('instagram') }}" 
                                       placeholder="https://instagram.com/profile">
                                @error('instagram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="snap">Snapchat URL</label>
                                <input type="url" class="form-control @error('snap') is-invalid @enderror" 
                                       id="snap" name="snap" value="{{ old('snap') }}" 
                                       placeholder="https://snapchat.com/profile">
                                @error('snap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="visibility" name="visibility" 
                                           {{ old('visibility') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="visibility">
                                        <strong>Visible on Website</strong>
                                        <div class="form-text">Show this team member on the about page</div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                     <input class="form-check-input" type="checkbox" id="is_chairman" name="is_chairman" 
                         {{ old('is_chairman', request('owner') ? true : false) ? 'checked' : '' }} onchange="toggleOwnerFields()">
                                    <label class="form-check-label" for="is_chairman">
                                        <strong>Business Owner</strong>
                                        <div class="form-text">Mark as business owner/founder</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Business Owner Specific Fields -->
                        <div class="card mb-4 {{ old('is_chairman', request('owner') ? true : false) ? '' : 'd-none' }}" id="ownerFields">
                            <div class="card-header">
                                <h6 class="mb-0 text-warning">
                                    <i class="bx bx-crown me-2"></i>Business Owner Specific Fields
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="business_title">Business Title</label>
                                    <input type="text" class="form-control @error('business_title') is-invalid @enderror" 
                                           id="business_title" name="business_title" value="{{ old('business_title') }}" 
                                           placeholder="e.g., Founder & CEO, Business Owner">
                                    <div class="form-text">Special title for business owner (overrides position on website)</div>
                                    @error('business_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="company_message">Company Message</label>
                                    <textarea class="form-control @error('company_message') is-invalid @enderror" 
                                              id="company_message" name="company_message" rows="3" 
                                              placeholder="Personal message from the business owner to customers...">{{ old('company_message') }}</textarea>
                                    <div class="form-text">This will be displayed prominently on the about page</div>
                                    @error('company_message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="vision_statement">Vision Statement</label>
                                        <textarea class="form-control @error('vision_statement') is-invalid @enderror" 
                                                  id="vision_statement" name="vision_statement" rows="4" 
                                                  placeholder="Company's vision for the future...">{{ old('vision_statement') }}</textarea>
                                        @error('vision_statement')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="thoughts">Philosophy & Thoughts</label>
                                        <textarea class="form-control @error('thoughts') is-invalid @enderror" 
                                                  id="thoughts" name="thoughts" rows="4" 
                                                  placeholder="Business philosophy and core beliefs...">{{ old('thoughts') }}</textarea>
                                        @error('thoughts')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        @section('pagejs')
                        <script>
                        function toggleOwnerFields() {
                            const isChairman = document.getElementById('is_chairman').checked;
                            const ownerFields = document.getElementById('ownerFields');
                            if (isChairman) {
                                ownerFields.classList.remove('d-none');
                            } else {
                                ownerFields.classList.add('d-none');
                            }
                        }
                        // Initialize on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            toggleOwnerFields();
                        });
                        </script>
                        @endsection

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.team.list') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-x me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> {{ request('owner') ? 'Save Owner' : 'Save Team Member' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection