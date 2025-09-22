@extends('layout.app')
@section('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
@section('content')
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    @php
    $bannerUrl = asset('images/banner/banner-6.jpg');
    @endphp


    <!-- <div class="wt-bnr-inr twm-inner-banner-s-bar site-bg-dark  twm-primary-overlay-wrap"
        style="background-image: url('{{ $bannerUrl }}');">

        <div class="container">
            <div class="wt-bnr-inr-entry">
                <div class="banner-title-outer">
                    <div class="banner-title-name">
                        <h2 class="wt-title">Cars Style 4</h2>
                    </div>

                   
                      
                   

                </div>
            </div>
        </div>

    </div> -->
    <!-- INNER PAGE BANNER END -->


    <!-- Team SECTION START -->
    <div class="section-full p-t50 site-bg-white twm-cars4-section-wrap">
        <div class="container">

            <div class="twm-search-list-filter-wrap">
                <form>
                    <div class="row g-3 align-items-end mb-4">
                        <div class="col-md-3">
                            <label for="filterBrand" class="form-label mb-2">Brand</label>
                            <select id="filterBrand" class="form-control mb-3">
                                <option value="">All</option>
                                @php
                                    $brands = collect($vehicles)->pluck('brand')->unique()->sort();
                                @endphp
                                @foreach($brands as $brand)
                                    <option value="{{ strtolower($brand) }}">{{ ucfirst($brand) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterFuel" class="form-label mb-2">Fuel Type</label>
                            <select id="filterFuel" class="form-control mb-3">
                                <option value="">All</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterBody" class="form-label mb-2">Body Type</label>
                            <input type="text" id="filterBody" class="form-control mb-3" placeholder="e.g. SUV">
                        </div>
                        <div class="col-md-3">
                            <label for="randomSearch" class="form-label mb-2">Search</label>
                            <input type="text" id="randomSearch" class="form-control mb-3" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="container-fluid">
            <div class="section-content">

                <div class=" twm-cars-section m-b30">


                    <div class="row" id="vehicleGrid">

                      

                        @foreach($vehicles as $vehicle)
                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 m-b30 wow fadeInDown" data-wow-delay="0.2">
                            <div class="twm-vehicle-fleet-bx2 twm-custom-grid-3">
                                <div class="twm-media">
                                    <div class="twm-media-pic">
                                        <img src="{{ $vehicle->thumbnail }}" alt="image">
                                    </div>
                                    <div class="twm-price-section">
                                        <div class="v-price">${{$vehicle->weekly}}</div>
                                        <div class="v-duration">/ Week</div>

                                    </div>
                                </div>
                                <div class="twm-vehicle-fleet-content">
                                    <h3 class="twm-v-title"><a href="cars-detail.html">{{strtoupper($vehicle->brand)}} {{strtoupper($vehicle->model)}} {{strtoupper($vehicle->year)}}</a></h3>
                                    <ul class="twm-vehicle-facility">
                                        <li><span><img src="{{ asset('/images/icons/car-seat.png')}}"
                                                    alt="Image"></span>{{ $vehicle->seats }}</li>
                                        <li><span><img src="{{ asset('/images/icons/bag.png')}}" alt="Image"></span>4
                                            Bags</li>
                                        <li><span><img src="{{ asset('/images/icons/car.png')}}" alt="Image"></span>{{$vehicle->body_type}}</li>
                                    </ul>
                                    <ul class="twm-vehicle-fuel-type">
                                        {{ $vehicle->fuel}}
                                    </ul>
                                    @if($vehicle->terms && is_array($vehicle->terms))
                                    <ul class="twm-vehicle-terms">
                                        @foreach($vehicle->terms as $term)
                                            <li>{{ $term }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
                    </div>

                    <!-- <div class="pagination-outer d-flex justify-content-center">
                        <div class="pagination-style1">
                            <ul class="clearfix">
                                <li class="prev"><a href="cars-grid-4.html"><span> <i
                                                class="fa-solid fa-chevron-left"></i> </span></a></li>
                                <li><a href="cars-grid-4.html">1</a></li>
                                <li class="active"><a href="cars-grid-4.html">2</a></li>
                                <li><a href="cars-grid-4.html">3</a></li>
                                <li class="next"><a href="cars-grid-4.html"><span> <i
                                                class="fa-solid fa-chevron-right"></i> </span></a></li>
                            </ul>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>

    </div>
    <!-- Team SECTION END -->



    <!--CLIENT SLIDER START-->
    <!-- <div class="twm-client-slider1-wrap site-bg-white">
        <div class="twm-client-slider1">
            <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w1.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w3.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w4.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w5.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w6.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w1.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w3.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="ow-client-logo">
                        <div class="client-logo client-logo-media">
                            <a href="cars-grid-4.html"><img src="{{ asset('/client-logo/dark/w5.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> -->
    <!-- CLIENT SLIDER END -->

</div>
@endsection
@section('page-js')
<script>
    window.allVehicles = @json($vehicles);
</script>


<script>
    // Store all vehicles (already available from backend)
 

    // Debounce utility: wait N ms after last call
    function debounce(func, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), delay);
        };
    }

    // Main rendering function
    function renderVehicles(vehicles) {
        const container = document.getElementById('vehicleGrid');
        container.innerHTML = '';

        if (vehicles.length === 0) {
            container.innerHTML = '<p>No vehicles found matching your criteria.</p>';
            return;
        }

        vehicles.forEach(vehicle => {
            const html = `
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 m-b30">
                    <div class="twm-vehicle-fleet-bx2 twm-custom-grid-3">
                        <div class="twm-media">
                            <div class="twm-media-pic">
                                <img src="${vehicle.thumbnail}" alt="image">
                            </div>
                            <div class="twm-price-section">
                                <div class="v-price">$${vehicle.weekly}</div>
                                <div class="v-duration">/ Week</div>
                            </div>
                        </div>
                        <div class="twm-vehicle-fleet-content">
                            <h3 class="twm-v-title">
                                <a href="cars-detail.html">${vehicle.brand.toUpperCase()} ${vehicle.model.toUpperCase()} ${vehicle.year}</a>
                            </h3>
                            <ul class="twm-vehicle-facility">
                                <li><span><img src="/images/icons/car-seat.png" alt="Image"></span>${vehicle.seats}</li>
                                <li><span><img src="/images/icons/bag.png" alt="Image"></span>4 Bags</li>
                                <li><span><img src="/images/icons/car.png" alt="Image"></span>${vehicle.body_type}</li>
                            </ul>
                            <ul class="twm-vehicle-fuel-type">${vehicle.fuel}</ul>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });
    }

    // Filter logic
    function filterVehicles() {
        const brand = document.getElementById('filterBrand').value.trim().toLowerCase();
        const fuel = document.getElementById('filterFuel').value.trim().toLowerCase();
        const body = document.getElementById('filterBody').value.trim().toLowerCase();
        const randomSearch = document.getElementById('randomSearch').value.trim().toLowerCase();

        const filtered = window.allVehicles.filter(vehicle => {
            const matchesBrand = brand ? (vehicle.brand && vehicle.brand.toLowerCase().includes(brand)) : true;
            const matchesFuel = fuel ? (vehicle.fuel && vehicle.fuel.toLowerCase() === fuel) : true;
            const matchesBody = body ? (vehicle.body_type && vehicle.body_type.toLowerCase().includes(body)) : true;

            let matchesRandom = true;
            if (randomSearch) {
                // Check if any field contains the random search string
                matchesRandom = Object.values(vehicle).some(val =>
                    (val !== null && val !== undefined && val.toString().toLowerCase().includes(randomSearch))
                );
            }

            return matchesBrand && matchesFuel && matchesBody && matchesRandom;
        });

        renderVehicles(filtered);
    }

    // Attach event listeners with debounce
    const debouncedFilter = debounce(filterVehicles, 300);

    document.getElementById('filterBrand').addEventListener('change', debouncedFilter);
    document.getElementById('filterBody').addEventListener('input', debouncedFilter);
    document.getElementById('filterFuel').addEventListener('change', filterVehicles); // no need to debounce select
    document.getElementById('randomSearch').addEventListener('input', debouncedFilter);

    // Initial render
    renderVehicles(window.allVehicles);
</script>

@endsection