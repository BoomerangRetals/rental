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
                            <label for="randomSearch" class="form-label mb-2">Search</label>
                            <input type="text" id="randomSearch" class="form-control mb-3" placeholder="Search">
                        </div>
                        <!-- Category filter removed; handled in layout.header -->
                    </div>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div class="section-content">

                <div class=" twm-cars-section m-b30">


                    <div class="row" id="partsGrid">
                        <!-- @foreach($parts as $part)
                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 m-b30 wow fadeInDown" data-wow-delay="0.2">
                            <div class="twm-vehicle-fleet-bx2 twm-custom-grid-3">
                                <div class="twm-media">
                                    <div class="twm-media-pic">
                                        <img src="{{ $part->thumbnail }}" alt="image">
                                    </div>
                                    <div class="twm-price-section">
                                        <div class="v-price">${{ $part->price }}</div>
                                    </div>
                                </div>
                                <div class="twm-vehicle-fleet-content">
                                    <h3 class="twm-v-title">
                                        <a href="#">{{ strtoupper($part->name) }}</a>
                                    </h3>
                                    <ul class="twm-vehicle-facility">
                                        <li>Part #: {{ $part->part_number }}</li>
                                        <li>
                                            Make: {{ $part->make }},
                                            Model: {{ $part->model }},
                                            Year: {{ $part->year }},
                                            <span style="color:{{ $part->quantity > 0 ? 'green' : 'red' }};font-weight:bold;">
                                                {{ $part->quantity > 0 ? 'Available' : 'Stock Out' }}
                                            </span>
                                        </li>
                                    </ul>
                                    <div class="twm-vehicle-fuel-type">
                                        {{ $part->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach -->
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
    window.allParts = JSON.parse('{!! addslashes(json_encode($parts)) !!}');
    window.currentCategory = "{!! addslashes($category ?? 'all') !!}";
    window.categories = JSON.parse('{!! addslashes(json_encode($categories ?? [])) !!}');
</script>

<script>
    // Debounce utility
    function debounce(func, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), delay);
        };
    }

    // Main rendering function for parts
    function renderParts(parts) {
        const container = document.getElementById('partsGrid');
        container.innerHTML = '';

        if (parts.length === 0) {
            container.innerHTML = '<p>No parts found matching your criteria.</p>';
            return;
        }

        parts.forEach(part => {
            const statusAvailable = part.quantity > 0;
            const statusText = statusAvailable ? 'Available' : 'Stock Out';
            const statusColor = statusAvailable ? 'green' : 'red';
            const html = `
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 m-b30">
                    <div class="twm-vehicle-fleet-bx2 twm-custom-grid-3">
                        <div class="twm-media">
                            <div class="twm-media-pic">
                                <img src="${part.thumbnail}" alt="image">
                            </div>
                            <div class="twm-price-section">
                                <div class="v-price">$${part.price}</div>
                            </div>
                        </div>
                        <div class="twm-vehicle-fleet-content">
                            <span style="color:${statusColor};font-weight:bold;">
                                    ${statusText}
                                </span> 
                            <h3 class="twm-v-title">
                                <a href="#">${part.name ? part.name.toUpperCase() : ''}</a>
                            </h3>
                            
                            
                            
                            <div class="d-flex flex-wrap align-items-center mb-2" style="gap:0.7rem 1.2rem;">
                                <div><span style="color:#ff6600;font-weight:600;">Part #:</span> <span style="color:#007bff;font-weight:600;">${part.part_number || ''}</span></div>
                                <div><span style="color:#28a745;font-weight:600;">Make:</span> <span style="color:#007bff;font-weight:600;">${part.make || ''}</span></div>
                                <div><span style="color:#6f42c1;font-weight:600;">Model:</span> <span style="color:#007bff;font-weight:600;">${part.model || ''}</span></div>
                                <div><span style="color:#e83e8c;font-weight:600;">Year:</span> <span style="color:#007bff;font-weight:600;">${part.year || ''}</span></div>
                            </div>
                            <div class="twm-vehicle-fuel-type">
                                ${part.description || ''}
                            </div>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });
    }

    // Filter logic for random search
    function filterParts() {
        const randomSearch = document.getElementById('randomSearch').value.trim().toLowerCase();

        const filtered = window.allParts.filter(part =>
            randomSearch
                ? Object.values(part).some(val =>
                    val !== null && val !== undefined && val.toString().toLowerCase().includes(randomSearch)
                )
                : true
        );

        renderParts(filtered);
    }

    // Attach event listener with debounce
    const debouncedFilter = debounce(filterParts, 300);
    document.getElementById('randomSearch').addEventListener('input', debouncedFilter);

    // Initial render
    renderParts(window.allParts);
</script>
@endsection