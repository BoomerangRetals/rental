@extends('admin.app')

@section('pagecss')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="../../assets/css/circular_custom.css" />
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Add Part</h5>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('uploadparts') }}" enctype="multipart/form-data" class="row g-3">
                    @csrf

                    <div class="col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="part_number">Part Number</label>
                        <input class="form-control" id="part_number" name="part_number" type="text" value="{{ old('part_number') }}" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="make">Make</label>
                        <input class="form-control" id="make" name="make" list="makesList" type="text" value="{{ old('make') }}" />
                        <datalist id="makesList">
                            @if(isset($makes))
                                @foreach($makes as $m)
                                    <option value="{{ $m }}" />
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="model">Model</label>
                        <input class="form-control" id="model" name="model" list="modelsList" type="text" value="{{ old('model') }}" />
                        <datalist id="modelsList">
                            @if(isset($models))
                                @foreach($models as $m)
                                    <option value="{{ $m }}" />
                                @endforeach
                            @endif
                        </datalist>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="year">Year</label>
                        <input class="form-control" id="year" name="year" type="number" value="{{ old('year') }}" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input class="form-control" id="quantity" name="quantity" type="number" value="{{ old('quantity', 0) }}" min="0" />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="cost">Cost (AUD)</label>
                        <div class="input-group">
                            <span class="input-group-text">AUD</span>
                            <input class="form-control" id="cost" name="cost" type="number" step="0.01" value="{{ old('cost', '0.00') }}" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="price">Price (AUD)</label>
                        <div class="input-group">
                            <span class="input-group-text">AUD</span>
                            <input class="form-control" id="price" name="price" type="number" step="0.01" value="{{ old('price', '0.00') }}" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="type">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option value="">Select Type</option>
                            <option value="e-bike" {{ old('type')=='e-bike' ? 'selected' : '' }}>E-Bike</option>
                            <option value="motorcycle" {{ old('type')=='motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                            <option value="car" {{ old('type')=='car' ? 'selected' : '' }}>Car</option>
                            <option value="other" {{ old('type')=='other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="supplier">Supplier</label>
                        <input class="form-control" id="supplier" name="supplier" type="text" value="{{ old('supplier') }}" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="reorder_level">Reorder Level</label>
                        <input class="form-control" id="reorder_level" name="reorder_level" type="number" value="{{ old('reorder_level', 0) }}" min="0" />
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="thumbnail">Thumbnail</label>
                        <input class="form-control" id="thumbnail" name="thumbnail" type="file" accept="image/*" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="images">Images</label>
                        <input class="form-control" id="images" name="images[]" type="file" accept="image/*" multiple />
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0" />
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-check form-switch">
                            <input type="hidden" name="visibility" value="0" />
                            <input class="form-check-input" type="checkbox" id="visibility" name="visibility" value="1" {{ old('visibility', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="visibility">Visible</label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary w-100">Add Part</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script src="../../assets/js/form-validation.js"></script>
@endsection
