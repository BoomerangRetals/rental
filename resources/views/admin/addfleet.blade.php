@extends('admin.app')


@section('pagecss')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="../../assets/css/circular_custom.css" />
@endsection

@section('content')
<!-- Content wrapper -->


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="col-12">
        <div class="card">
            <h5 class="card-header">Add Fleet</h5>
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
                <form id="formValidationExamples" class="row g-6 needs-validation" method="POST" enctype="multipart/form-data" novalidate action="{{ route('uploadfleet') }}">
                    @csrf
                    <!-- Listing Type First -->
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="listing_type">Listing Type</label>
                        <select id="listing_type" name="listing_type" class="form-select select2" data-allow-clear="true" required>
                            <option value="">Select Listing Type</option>
                            <option value="rent">Rent</option>
                            <option value="sell">Sell</option>    
                        </select>
                        <div class="invalid-feedback">Please select a listing type.</div>
                    </div>
                    <!-- Account Details -->
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="brand">Brand</label>
                        <select id="brand" name="brand" class="form-select select2" required>
                            <option value="">Select Brand</option>
                            <option value="toyota">Toyota</option>
                            <option value="ford">Ford</option>
                            <option value="mazda">Mazda</option>
                            <option value="kia">Kia</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="mitsubishi">Mitsubishi</option>
                            <option value="mg">MG</option>
                            <option value="isuzu ute">Isuzu Ute</option>
                            <option value="nissan">Nissan</option>
                            <option value="gwm">GWM</option>
                            <option value="byd">BYD</option>
                            <option value="tesla">Tesla</option>
                            <option value="subaru">Subaru</option>
                            <option value="volkswagen">Volkswagen</option>
                            <option value="bmw">BMW</option>
                            <option value="mercedes-benz">Mercedes</option>
                            <option value="audi">Audi</option>
                            <option value="lexus">Lexus</option>
                            <option value="honda">Honda</option>
                            <option value="volvo">Volvo</option>
                            <option value="land rover">Land Rover</option>
                            <option value="yamaha">Yamaha</option>
                            <option value="honda">Honda</option>
                            <option value="harley-davidson">Harley-Davidson</option>
                            <option value="ducati">Ducati</option>
                            <option value="triumph">Triumph</option>
                            <option value="hunter">Hunter Motorcycles</option>
                            <option value="kawasaki">Kawasaki</option>
                            <option value="suzuki">Suzuki</option>
                            <option value="bmw motorrad">BMW Motorrad</option>
                            <option value="royal enfield">Royal Enfield</option>
                            <option value="ktm">KTM</option>
                            <option value="aprilia">Aprilia</option>
                            <option value="vespa">Vespa</option>
                            <option value="piaggio">Piaggio</option>
                            <option value="ncm">NCM</option>
                            <option value="sunmono">Sunmono</option>
                            <option value="vnix">Vnix</option>
                            <option value="lithium">Lithium</option>
                            <option value="neptune">Neptune</option>
                        </select>
                        <div class="invalid-feedback">Please select a brand.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="model">Model</label>
                        <input class="form-control typeahead" type="text" id="model" name="model" autocomplete="on" required />
                        <div class="invalid-feedback">Please enter a model.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="year">Year</label>
                        <select id="year" name="year" class="form-select select2"  required>
                            <option value="">Select Year</option>
                            @for ($year = date('Y'); $year >= 1990; $year--)
                            <option value="{{ strtolower($year) }}">{{ $year }}</option>
                            @endfor
                        </select>
                        <div class="invalid-feedback">Please select a year.</div>
                    </div>

                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="plate_number">Registration Number</label>
                        <input class="form-control typeahead" type="text" id="registration_number" name="registration_number" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="vin_number">VIN Number</label>
                        <input class="form-control typeahead" type="text" id="vin_number" name="vin_number" autocomplete="off" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="engine_number">Engine Number</label>
                        <input class="form-control typeahead" type="text" id="engine_number" name="engine_number"/>
                    </div>
                    
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="fleet_type">Fleet Type</label>
                        <select id="fleet_type" name="fleet_type" class="form-select select2" required>
                            <option value="">Select Fleet Type</option>
                            <option value="car">Car</option>
                            <option value="motorcycle">Motorcycle</option>
                            <option value="scooter">Scooter</option>
                            <option value="e-bike">E-Bike</option>
                            <option value="van">Van</option>
                            <option value="other">Other</option>
                       
                        </select>
                        <div class="invalid-feedback">Please select a fleet type.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="colour">Colour</label>
                        <select id="colour" name="colour" class="form-select select2">
                            <option value="">Select colour</option>
                            <option value="white">White</option>
                            <option value="black">Black</option>
                            <option value="grey">Grey</option>
                            <option value="silver">Silver</option>
                            <option value="blue">Blue</option>
                            <option value="red">Red</option>
                            <option value="brown">Brown</option>
                            <option value="green">Green</option>
                            <option value="beige">Beige</option>
                            <option value="yellow">Yellow</option>
                            <option value="gold">Gold</option>
                            <option value="orange">Orange</option>
                            <option value="purple">Purple</option>
                            <option value="pink">Pink</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="seats">Seats</label>
                        <select id="seats" name="seats" class="form-select select2" data-allow-clear="true">
                            <option value="">Select Seat</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9+">9+</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="doors">Doors</label>
                        <select id="doors" name="doors" class="form-select select2" data-allow-clear="true">
                            <option value="">Select Doors</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            
                            
                        </select>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="transmission">Transmission</label>
                        <select id="transmission" name="transmission" class="form-select select2" data-allow-clear="true">
                            <option value="">Select Transmission</option>
                            <option value="automatic">Automatic</option>
                            <option value="manual">Manual</option>
                            <option value="other">Other</option>
                     
                        </select>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="fuel_type">Fuel Type</label>
                        <select id="fuel_type" name="fuel_type" class="form-select select2" data-allow-clear="true" required>
                            <option value="">Select Fuel Type</option>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="other">Other</option>
                      
                        </select>
                        <div class="invalid-feedback">Please select a fuel type.</div>
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="body_type">Body Type</label>
                        <select id="body_type" name="body_type" class="form-select select2" data-allow-clear="true">
                            <option value="">Select Body Type</option>
                            <option value="sedan">Sedan</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="suv">SUV</option>
                            <option value="coupe">Coupe</option>
                            <option value="convertible">Convertible</option>
                            <option value="wagon">Wagon</option>
                            <option value="van">Van</option>
                            <option value="ute">Ute</option>
                            <option value="truck">Truck</option>
                            <option value="other">Other</option>
                            
                        </select>
                    </div>
                    <!-- Price, Tracker, Tracker Details (Rental) -->
                    <div class="col-md-6 form-control-validation rental-input">
                        <label class="form-label" for="engine_number">Price</label>
                        <input class="form-control typeahead" type="number" id="weekly" name="weekly" />
                    </div>
                    <div class="col-md-6 form-control-validation rental-input">
                        <label class="form-label" for="tracker">Tracker</label>
                        <input class="form-control" type="text" id="tracker" name="tracker" placeholder="Tracker (optional)" />
                    </div>
                    <div class="col-md-6 form-control-validation rental-input">
                        <label class="form-label" for="tracker_details">Tracker Details</label>
                        <input class="form-control" type="text" id="tracker_details" name="tracker_details" placeholder="Tracker Details (optional)" />
                    </div>
                    <div class="col-md-6 form-control-validation rental-input">
                        <label class="form-label" for="bond">Bond</label>
                        <input class="form-control" type="number" id="bond" name="bond" placeholder="Bond (optional)" />
                    </div>
                    <!-- Sell Price (Sell) -->
                    <div class="col-md-6 form-control-validation sell-input" style="display:none;">
                        <label class="form-label" for="sell_price">Sell Price</label>
                        <input class="form-control" type="number" id="sell_price" name="sell_price" placeholder="Sell Price" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="fleet_pictures" class="form-label">Fleet Thumbnail</label>
                        <input class="form-control" type="file" id="fleet_thumbnail" name="fleet_thumbnail" />
                    </div>
                    <div class="col-md-6 form-control-validation">
                        <label for="fleet_pictures" class="form-label">Fleet Pictures</label>
                        <input class="form-control" type="file" id="fleet_pictures" name="fleet_pictures[]" multiple />
                    </div>
                    
                    

                    <div class="col-md-6 form-control-validation">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    

                    <!-- Choose Your Plan -->



                    <div class="col-md-6 mt-4 form-control-validation">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="visible" name="visible" checked/>
                            <label class="form-check-label" for="visible">Visible</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="available" name="available" checked/>
                            <label class="form-check-label" for="available">Available</label>
                        </div>
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="ready" value="0" />
                            <input class="form-check-input" type="checkbox" id="ready" name="ready" value="1" checked />
                            <label class="form-check-label" for="ready">Ready</label>
                        </div>
                    </div>
                    <div class="col-12 mt-4 form-control-validation">
                        <button type="submit" name="submitButton" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('pagejs')
<script src="../../assets/js/form-validation.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script>

// Bootstrap validation only
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();

// Listing type show/hide logic
(function() {
    function toggleListingInputs() {
        var type = document.getElementById('listing_type').value;
        var rentalInputs = document.querySelectorAll('.rental-input');
        var sellInputs = document.querySelectorAll('.sell-input');
        if (type === 'rent') {
            rentalInputs.forEach(function(el) { el.style.display = ''; });
            sellInputs.forEach(function(el) { el.style.display = 'none'; });
        } else if (type === 'sell') {
            rentalInputs.forEach(function(el) { el.style.display = 'none'; });
            sellInputs.forEach(function(el) { el.style.display = ''; });
        } else {
            rentalInputs.forEach(function(el) { el.style.display = 'none'; });
            sellInputs.forEach(function(el) { el.style.display = 'none'; });
        }
    }
    document.getElementById('listing_type').addEventListener('change', toggleListingInputs);
    // On page load
    toggleListingInputs();
})();
</script>
@endsection