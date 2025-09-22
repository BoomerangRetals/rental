@extends('admin.app')

@section('page-title', 'Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0 text-white">
                                <i class="ti ti-settings me-2"></i>System Settings
                            </h4>
                            <p class="mb-0 opacity-75 small">Configure your system preferences and company information</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-light text-primary">
                                <i class="ti ti-clock me-1"></i>Last updated: {{ now()->format('M j, Y') }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mx-4 mt-4 mb-0" role="alert">
                            <i class="ti ti-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mx-4 mt-4 mb-0" role="alert">
                            <i class="ti ti-alert-circle me-2"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settings-form">
                        @csrf
                        @method('PUT')

                        <!-- Enhanced Settings Tabs -->
                        <div class="px-4 pt-4">
                            <ul class="nav nav-pills nav-fill gap-2 p-1 bg-light rounded" id="settingsTabs" role="tablist">
                                @foreach($settings as $groupName => $groupSettings)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded {{ $loop->first ? 'active' : '' }}" 
                                                id="{{ $groupName }}-tab" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#{{ $groupName }}" 
                                                type="button" 
                                                role="tab">
                                            @switch($groupName)
                                                @case('company')
                                                    <i class="ti ti-building me-2"></i>Company
                                                    @break
                                                @case('invoice')
                                                    <i class="ti ti-file-invoice me-2"></i>Invoice
                                                    @break
                                                @case('general')
                                                    <i class="ti ti-settings me-2"></i>General
                                                    @break
                                                @default
                                                    <i class="ti ti-folder me-2"></i>{{ ucfirst($groupName) }}
                                            @endswitch
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Enhanced Tab Content -->
                        <div class="tab-content p-4" id="settingsTabContent">
                            @foreach($settings as $groupName => $groupSettings)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                     id="{{ $groupName }}" 
                                     role="tabpanel">
                                    
                                    <!-- Group Header -->
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar avatar-lg me-3">
                                            <div class="avatar-initial bg-primary rounded-circle">
                                                @switch($groupName)
                                                    @case('company')
                                                        <i class="ti ti-building fs-4"></i>
                                                        @break
                                                    @case('invoice')
                                                        <i class="ti ti-file-invoice fs-4"></i>
                                                        @break
                                                    @case('general')
                                                        <i class="ti ti-settings fs-4"></i>
                                                        @break
                                                    @default
                                                        <i class="ti ti-folder fs-4"></i>
                                                @endswitch
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">{{ ucfirst($groupName) }} Settings</h5>
                                            <p class="text-muted mb-0">
                                                @switch($groupName)
                                                    @case('company')
                                                        Configure your company information and branding
                                                        @break
                                                    @case('invoice')
                                                        Customize invoice appearance and formatting
                                                        @break
                                                    @case('general')
                                                        General system preferences and defaults
                                                        @break
                                                    @default
                                                        Configure {{ $groupName }} settings
                                                @endswitch
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Settings Grid -->
                                    <div class="row g-4">
                                        @foreach($groupSettings as $setting)
                                            <div class="col-lg-6">
                                                <div class="card border h-100 setting-card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start mb-3">
                                                            <div class="avatar avatar-sm me-3">
                                                                <div class="avatar-initial bg-light text-primary rounded">
                                                                    @switch($setting->type)
                                                                        @case('text')
                                                                        @case('email')
                                                                            <i class="ti ti-abc fs-6"></i>
                                                                            @break
                                                                        @case('color')
                                                                            <i class="ti ti-palette fs-6"></i>
                                                                            @break
                                                                        @case('image')
                                                                            <i class="ti ti-photo fs-6"></i>
                                                                            @break
                                                                        @case('number')
                                                                            <i class="ti ti-hash fs-6"></i>
                                                                            @break
                                                                        @case('textarea')
                                                                            <i class="ti ti-file-text fs-6"></i>
                                                                            @break
                                                                        @case('checkbox')
                                                                            <i class="ti ti-toggle-left fs-6"></i>
                                                                            @break
                                                                        @default
                                                                            <i class="ti ti-settings fs-6"></i>
                                                                    @endswitch
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <label for="setting_{{ $setting->key }}" class="form-label fw-semibold mb-1">
                                                                    {{ $setting->label }}
                                                                </label>
                                                                @if($setting->description)
                                                                    <small class="text-muted d-block mb-2">{{ $setting->description }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @switch($setting->type)
                                                            @case('text')
                                                            @case('email')
                                                                <input type="{{ $setting->type }}" 
                                                                       class="form-control form-control-lg" 
                                                                       id="setting_{{ $setting->key }}"
                                                                       name="settings[{{ $setting->key }}]" 
                                                                       value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                                       placeholder="{{ $setting->label }}">
                                                                @break

                                                            @case('number')
                                                                <div class="input-group input-group-lg">
                                                                    <input type="number" 
                                                                           class="form-control" 
                                                                           id="setting_{{ $setting->key }}"
                                                                           name="settings[{{ $setting->key }}]" 
                                                                           value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                                           step="0.01"
                                                                           min="0">
                                                                    @if($setting->key == 'tax_rate')
                                                                        <span class="input-group-text">%</span>
                                                                    @endif
                                                                </div>
                                                                @break

                                                            @case('textarea')
                                                                <textarea class="form-control form-control-lg" 
                                                                          id="setting_{{ $setting->key }}"
                                                                          name="settings[{{ $setting->key }}]" 
                                                                          rows="4"
                                                                          placeholder="{{ $setting->label }}">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>
                                                                @break

                                                            @case('color')
                                                                <div class="d-flex align-items-center gap-3">
                                                                    <div class="color-preview-wrapper">
                                                                        <input type="color" 
                                                                               class="form-control form-control-color border-0 p-1" 
                                                                               id="setting_{{ $setting->key }}"
                                                                               name="settings[{{ $setting->key }}]" 
                                                                               value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                                               style="width: 60px; height: 60px; border-radius: 8px;">
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <input type="text" 
                                                                               class="form-control form-control-lg font-monospace" 
                                                                               value="{{ old('settings.' . $setting->key, $setting->value) }}"
                                                                               readonly>
                                                                        <small class="text-muted">Click color box to change</small>
                                                                    </div>
                                                                </div>
                                                                @break

                                                            @case('image')
                                                                <div class="image-upload-container">
                                                                    @if($setting->value)
                                                                        <div class="current-image mb-3 text-center">
                                                                            <img src="{{ $setting->value }}" 
                                                                                 alt="{{ $setting->label }}" 
                                                                                 class="img-thumbnail rounded shadow-sm" 
                                                                                 style="max-height: 120px;">
                                                                        </div>
                                                                    @endif
                                                                    <div class="upload-area border border-dashed border-2 rounded p-4 text-center">
                                                                        <input type="file" 
                                                                               class="form-control d-none" 
                                                                               id="setting_{{ $setting->key }}"
                                                                               name="settings[{{ $setting->key }}]" 
                                                                               accept="image/*">
                                                                        <div class="upload-placeholder">
                                                                            <i class="ti ti-cloud-upload fs-1 text-muted mb-2"></i>
                                                                            <p class="mb-2">Click to upload new image</p>
                                                                            <small class="text-muted">Supports JPG, PNG, GIF up to 2MB</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @break

                                                            @case('checkbox')
                                                                <div class="form-check form-switch form-check-lg">
                                                                    <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                                                    <input type="checkbox" 
                                                                           class="form-check-input" 
                                                                           id="setting_{{ $setting->key }}"
                                                                           name="settings[{{ $setting->key }}]" 
                                                                           value="1"
                                                                           {{ old('settings.' . $setting->key, $setting->value) ? 'checked' : '' }}>
                                                                    <label class="form-check-label fw-medium" for="setting_{{ $setting->key }}">
                                                                        Enable this feature
                                                                    </label>
                                                                </div>
                                                                @break
                                                        @endswitch
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Enhanced Action Bar -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                                        <i class="ti ti-refresh me-2"></i>Reset Changes
                                    </button>
                                    <button type="button" class="btn btn-outline-info" onclick="exportSettings()">
                                        <i class="ti ti-download me-2"></i>Export Settings
                                    </button>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-warning" onclick="previewChanges()">
                                        <i class="ti ti-eye me-2"></i>Preview
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-lg px-4">
                                        <i class="ti ti-device-floppy me-2"></i>Save Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<style>
.setting-card {
    transition: all 0.3s ease;
    border: 1px solid #e7e7ef !important;
}

.setting-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
    border-color: #696cff !important;
}

.color-preview-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.upload-area {
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.upload-area:hover {
    background: #e9ecef;
    border-color: #696cff !important;
}

.upload-placeholder {
    pointer-events: none;
}

.nav-pills .nav-link {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.nav-pills .nav-link.active {
    background: #696cff !important;
    border-color: #696cff !important;
}

.nav-pills .nav-link:not(.active):hover {
    background: rgba(105, 108, 255, 0.1);
    border-color: rgba(105, 108, 255, 0.2);
}

.avatar-initial {
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.form-control-lg {
    font-size: 0.95rem;
}

.image-upload-container .current-image img {
    transition: all 0.3s ease;
}

.image-upload-container:hover .current-image img {
    transform: scale(1.05);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced color picker functionality
    document.querySelectorAll('input[type="color"]').forEach(function(colorInput) {
        const textInput = colorInput.closest('.d-flex').querySelector('input[type="text"]');
        
        colorInput.addEventListener('input', function() {
            textInput.value = this.value.toUpperCase();
            // Add visual feedback
            colorInput.style.boxShadow = `0 0 0 3px ${this.value}33`;
        });
        
        colorInput.addEventListener('blur', function() {
            colorInput.style.boxShadow = 'none';
        });
        
        textInput.addEventListener('input', function() {
            if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                colorInput.value = this.value;
            }
        });
    });
    
    // Enhanced image upload functionality
    document.querySelectorAll('.upload-area').forEach(function(uploadArea) {
        const fileInput = uploadArea.querySelector('input[type="file"]');
        
        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    let img = uploadArea.parentElement.querySelector('.current-image img');
                    if (!img) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'current-image mb-3 text-center';
                        imageDiv.innerHTML = `<img class="img-thumbnail rounded shadow-sm" style="max-height: 120px;">`;
                        uploadArea.parentElement.insertBefore(imageDiv, uploadArea);
                        img = imageDiv.querySelector('img');
                    }
                    img.src = e.target.result;
                    img.alt = file.name;
                    
                    // Update upload area text
                    const placeholder = uploadArea.querySelector('.upload-placeholder p');
                    placeholder.textContent = `Selected: ${file.name}`;
                };
                reader.readAsDataURL(file);
            }
        });
    });
    
    // Form validation and save state
    const form = document.getElementById('settings-form');
    let hasUnsavedChanges = false;
    
    form.addEventListener('input', function() {
        hasUnsavedChanges = true;
        updateSaveButton();
    });
    
    function updateSaveButton() {
        const saveBtn = document.querySelector('button[type="submit"]');
        if (hasUnsavedChanges) {
            saveBtn.classList.add('btn-warning');
            saveBtn.classList.remove('btn-primary');
            saveBtn.innerHTML = '<i class="ti ti-device-floppy me-2"></i>Save Changes*';
        } else {
            saveBtn.classList.add('btn-primary');
            saveBtn.classList.remove('btn-warning');
            saveBtn.innerHTML = '<i class="ti ti-device-floppy me-2"></i>Save Settings';
        }
    }
    
    // Prevent accidental navigation
    window.addEventListener('beforeunload', function(e) {
        if (hasUnsavedChanges) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
    
    // Reset changes after successful save
    form.addEventListener('submit', function() {
        hasUnsavedChanges = false;
    });
    
    // Auto-save functionality (optional)
    let autoSaveTimeout;
    form.addEventListener('input', function() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(function() {
            // Could implement auto-save here
            console.log('Auto-save would trigger here');
        }, 5000);
    });
});

function resetForm() {
    if (confirm('Are you sure you want to reset all changes? This will reload the page and lose any unsaved changes.')) {
        location.reload();
    }
}

function previewChanges() {
    // Collect current form values
    const formData = new FormData(document.getElementById('settings-form'));
    const changes = [];
    
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('settings[')) {
            const settingKey = key.match(/settings\[(.*?)\]/)[1];
            changes.push({key: settingKey, value: value});
        }
    }
    
    // Show preview modal or summary
    let previewContent = '<h5>Preview of Changes:</h5><ul class="list-group">';
    changes.forEach(change => {
        previewContent += `<li class="list-group-item d-flex justify-content-between">
            <strong>${change.key}:</strong> 
            <span class="text-muted">${change.value || 'Empty'}</span>
        </li>`;
    });
    previewContent += '</ul>';
    
    // Create and show modal (you might want to use a proper modal here)
    alert('Preview functionality would show a modal with current settings values');
}

function exportSettings() {
    // Export current settings as JSON
    const formData = new FormData(document.getElementById('settings-form'));
    const settings = {};
    
    for (let [key, value] of formData.entries()) {
        if (key.startsWith('settings[')) {
            const settingKey = key.match(/settings\[(.*?)\]/)[1];
            settings[settingKey] = value;
        }
    }
    
    const dataStr = JSON.stringify(settings, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    
    const link = document.createElement('a');
    link.href = url;
    link.download = `boomerang-settings-${new Date().toISOString().split('T')[0]}.json`;
    link.click();
    
    URL.revokeObjectURL(url);
}

// Add smooth scrolling to form sections
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function() {
        setTimeout(() => {
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 100);
    });
});
</script>
@endsection