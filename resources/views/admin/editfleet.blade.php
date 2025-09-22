@extends('admin.app')

@section('pagecss')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="../../assets/css/circular_custom.css" />
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Edit Fleet</h5>
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
                <form class="row g-6 needs-validation" method="POST" enctype="multipart/form-data" novalidate action="{{ route('admin.fleet.update', $vehicle->id) }}">
                    @csrf
                    @method('POST')
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="brand">Brand</label>
                        <input class="form-control" type="text" id="brand" name="brand" value="{{ old('brand', $vehicle->brand) }}" required />
                        <div class="invalid-feedback">Please select a brand.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="model">Model</label>
                        <input class="form-control" type="text" id="model" name="model" value="{{ old('model', $vehicle->model) }}" required />
                        <div class="invalid-feedback">Please enter a model.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="year">Year</label>
                        <input class="form-control" type="number" id="year" name="year" value="{{ old('year', $vehicle->year) }}" required />
                        <div class="invalid-feedback">Please select a year.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="registration_number">Registration Number</label>
                        <input class="form-control" type="text" id="registration_number" name="registration_number" value="{{ old('registration_number', $vehicle->registration_number) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="vin">VIN Number</label>
                        <input class="form-control" type="text" id="vin" name="vin" value="{{ old('vin', $vehicle->vin) }}" required />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="engine_no">Engine Number</label>
                        <input class="form-control" type="text" id="engine_no" name="engine_no" value="{{ old('engine_no', $vehicle->engine_no) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="weekly">Price</label>
                        <input class="form-control" type="number" id="weekly" name="weekly" value="{{ old('weekly', $vehicle->weekly) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="bond">Bond</label>
                        <input class="form-control" type="number" id="bond" name="bond" value="{{ old('bond', $vehicle->bond) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="tracker">Tracker</label>
                        <input class="form-control" type="text" id="tracker" name="tracker" value="{{ old('tracker', $vehicle->tracker) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="tracker_details">Tracker Details</label>
                        <input class="form-control" type="text" id="tracker_details" name="tracker_details" value="{{ old('tracker_details', $vehicle->tracker_details) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="colour">Colour</label>
                        <input class="form-control" type="text" id="colour" name="colour" value="{{ old('colour', $vehicle->colour) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="seats">Seats</label>
                        <input class="form-control" type="number" id="seats" name="seats" value="{{ old('seats', $vehicle->seats) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="doors">Doors</label>
                        <input class="form-control" type="number" id="doors" name="doors" value="{{ old('doors', $vehicle->doors) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="transmission">Transmission</label>
                        <input class="form-control" type="text" id="transmission" name="transmission" value="{{ old('transmission', $vehicle->transmission) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="fuel">Fuel Type</label>
                        <input class="form-control" type="text" id="fuel" name="fuel" value="{{ old('fuel', $vehicle->fuel) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="body_type">Body Type</label>
                        <input class="form-control" type="text" id="body_type" name="body_type" value="{{ old('body_type', $vehicle->body_type) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="series">Series</label>
                        <input class="form-control" type="text" id="series" name="series" value="{{ old('series', $vehicle->series) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="reference">Reference</label>
                        <input class="form-control" type="text" id="reference" name="reference" value="{{ old('reference', $vehicle->reference) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="vehicle_type">Vehicle Type</label>
                        <input class="form-control" type="text" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type', $vehicle->vehicle_type) }}" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="thumbnail">Thumbnail</label>
                        <input class="form-control" type="file" id="thumbnail" name="thumbnail" />
                        @if($vehicle->thumbnail)
                            <img src="{{ $vehicle->thumbnail }}" alt="Current Thumbnail" style="max-width:120px; margin-top:10px;" />
                        @endif
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="images">Fleet Pictures</label>
                        <input class="form-control" type="file" id="images" name="images[]" multiple />
                        @if($vehicle->images)
                            @foreach(json_decode($vehicle->images, true) as $img)
                                <img src="{{ $img }}" alt="Fleet Image" style="max-width:80px; margin:2px;" />
                            @endforeach
                        @endif
                    </div>
                    <div class="col-md-6 mt-4 form-control-validation">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="visibility" name="visibility" {{ old('visibility', $vehicle->visibility) ? 'checked' : '' }} />
                            <label class="form-check-label" for="visibility">Visible</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="status" name="status" {{ old('status', $vehicle->status) ? 'checked' : '' }} />
                            <label class="form-check-label" for="status">Available</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="ready" name="ready" {{ old('ready', $vehicle->ready) ? 'checked' : '' }} />
                            <label class="form-check-label" for="ready">Ready</label>
                        </div>
                    </div>
                    <div class="col-12 mt-4 form-control-validation">
                        <button type="submit" class="btn btn-primary w-100">Update Fleet</button>
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
