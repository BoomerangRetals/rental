@extends('admin.app')

@section('page-title', 'Fleet Management')

@section('pagecss')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="../../assets/css/circular_custom.css" />
<style>
.vehicle-photo-fixed {
    width: 500px;
    height: 150px;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endsection

@section('content')
<!-- Content wrapper -->


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-academy">
        <!-- Filter/Search Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <form id="fleetFilterForm">
                    <div class="row g-3 align-items-end mb-2">
                        <div class="col-md-3">
                            <label for="filterBrand" class="form-label mb-2">Brand</label>
                            <select id="filterBrand" class="form-control mb-3">
                                <option value="">All</option>
                                @php
                                    $brands = [];
                                    $fuels = [];
                                    $bodies = [];
                                    foreach ($vehicles as $vehicle) {
                                        if ($vehicle->brand && !in_array(strtolower($vehicle->brand), $brands)) {
                                            $brands[] = strtolower($vehicle->brand);
                                        }
                                        if ($vehicle->fuel && !in_array(strtolower($vehicle->fuel), $fuels)) {
                                            $fuels[] = strtolower($vehicle->fuel);
                                        }
                                        if ($vehicle->body_type && !in_array(strtolower($vehicle->body_type), $bodies)) {
                                            $bodies[] = strtolower($vehicle->body_type);
                                        }
                                    }
                                    sort($brands);
                                    sort($fuels);
                                    sort($bodies);
                                @endphp
                                @foreach($brands as $brand)
                                    <option value="{{ $brand }}">{{ ucfirst($brand) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterFuel" class="form-label mb-2">Fuel Type</label>
                            <select id="filterFuel" class="form-control mb-3">
                                <option value="">All</option>
                                @foreach($fuels as $fuel)
                                    <option value="{{ $fuel }}">{{ ucfirst($fuel) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filterBody" class="form-label mb-2">Body Type</label>
                            <select id="filterBody" class="form-control mb-3">
                                <option value="">All</option>
                                @foreach($bodies as $body)
                                    <option value="{{ $body }}">{{ ucfirst($body) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="randomSearch" class="form-label mb-2">Search</label>
                            <input type="text" id="randomSearch" class="form-control mb-3" placeholder="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Filter/Search Bar -->
        <div class="card mb-1">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <span id="vehicleCount" class="fw">  {{ $vehicles->count() }} items</span>
                </div>
                <div class="row gy-6 mb-6" id="vehicleGrid">
                    @if ($vehicles->isEmpty())
                    <p>No vehicles found.</p>
                    @else
                    @foreach ($vehicles as $vehicle)
                    <div class="col-sm-6 col-lg-4 mb-2">
                        <div class="card p-2 h-100 shadow-none border">
                            <div class="rounded-2 text-center mb-4">
                                <a href="app-academy-course-details.html"><img class="img-fluid vehicle-photo-fixed"
                                        src="https://www.longotoyota.com/blogs/4337/wp-content/uploads/2023/01/2023-Toyota-RAV4-1024x576.jpg"
                                        alt="" /></a>
                            </div>
                            <div class="card-body p-4 pt-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-label-danger fs-3">${{$vehicle->weekly}}</span>

                                </div>
                                <a href="" class="h5">{{$vehicle->year}} {{ $vehicle->brand }} {{ $vehicle->model }} 
                                  @if ($vehicle->registration_number) (
                                  {{$vehicle->registration_number}}
                                  )
                                  @endif
                                </a>
                                <p class="mt-1">Features and terms</p>


                                <div
                                    class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                    <a class="w-100 btn btn-label-primary d-flex align-items-center"
    href="{{ route('admin.fleet.edit', $vehicle->id) }}">
    <i class="ti ti-pencil icon-xs align-middle scaleX-n1-rtl me-2"></i><span>Edit</span>
</a>


                                </div>
                                <div class="mt-4 d-flex ">
                                    <label class="switch switch-primary">
                                        <input type="checkbox" class="switch-input visibility-switch" data-id="{{ $vehicle->id }}" @if ($vehicle->visibility) checked @endif />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="icon-base ti tabler-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="icon-base ti tabler-x"></i>
                                            </span>
                                        </span>
                                        <span class="switch-label">Visibile</span>
                                    </label>
                                    <label class="switch switch-warning ms-3">
                                        <input type="checkbox" class="switch-input available-switch ms-3" data-id="{{ $vehicle->id }}" @if ($vehicle->status) checked @endif />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="icon-base ti tabler-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="icon-base ti tabler-x"></i>
                                            </span>
                                        </span>
                                        <span class="switch-label">Available</span>
                                    </label>
                                    <label class="switch switch-success ms-3">
                                        <input type="checkbox" class="switch-input ready-switch ms-3" data-id="{{ $vehicle->id }}" @if ($vehicle->ready) checked @endif />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="icon-base ti tabler-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="icon-base ti tabler-x"></i>
                                            </span>
                                        </span>
                                        <span class="switch-label">Ready</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif



                </div>

            </div>
        </div>




    </div>
</div>


@endsection


@section('pagejs')


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>
<script>
loadScript("../../assets/js/circular_custom.js");

function loadScript(scriptSrc) {
    var script = document.createElement('script');
    script.src = scriptSrc;
    document.head.appendChild(script);
}
</script>
<script>
    window.allVehicles = @json($vehicles);
    function debounce(func, delay) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), delay);
        };
    }
    function renderVehicles(vehicles) {
        const container = document.getElementById('vehicleGrid');
        const countSpan = document.getElementById('vehicleCount');
        container.innerHTML = '';
        if (countSpan) countSpan.textContent = `  ${vehicles.length} items`;
        if (vehicles.length === 0) {
            container.innerHTML = '<p>No vehicles found matching your criteria.</p>';
            return;
        }
        vehicles.forEach(vehicle => {
            const reg = vehicle.registration_number ? ` (${vehicle.registration_number})` : '';
            const html = `
                <div class="col-sm-6 col-lg-4 mb-2">
                    <div class="card p-2 h-100 shadow-none border">
                        <div class="rounded-2 text-center mb-4">
                            <a href="/fleet/${vehicle.id}/edit"><img class="img-fluid vehicle-photo-fixed" src="${vehicle.thumbnail || 'https://www.longotoyota.com/blogs/4337/wp-content/uploads/2023/01/2023-Toyota-RAV4-1024x576.jpg'}" alt="" /></a>
                        </div>
                        <div class="card-body p-4 pt-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-label-danger fs-3">$${vehicle.weekly}</span>
                            </div>
                            <a href="/fleet/${vehicle.id}/edit" class="h5">${vehicle.year} ${vehicle.brand} ${vehicle.model}${reg}</a>
                            <p class="mt-1">Features and terms</p>
                            <div class="d-flex flex-column flex-md-row gap-4 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                <a class="w-100 btn btn-label-primary d-flex align-items-center" href="/fleet/${vehicle.id}/edit">
                                    <i class="ti ti-pencil icon-xs align-middle scaleX-n1-rtl me-2"></i><span>Edit</span>
                                </a>
                            </div>
                            <div class="mt-4 d-flex ">
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input visibility-switch" data-id="${vehicle.id}" ${vehicle.visibility ? 'checked' : ''} />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="icon-base ti tabler-check"></i></span>
                                        <span class="switch-off"><i class="icon-base ti tabler-x"></i></span>
                                    </span>
                                    <span class="switch-label">Visibile</span>
                                </label>
                                <label class="switch switch-warning ms-3">
                                    <input type="checkbox" class="switch-input available-switch" data-id="${vehicle.id}" ${vehicle.status ? 'checked' : ''} />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="icon-base ti tabler-check"></i></span>
                                        <span class="switch-off"><i class="icon-base ti tabler-x"></i></span>
                                    </span>
                                    <span class="switch-label">Available</span>
                                </label>
                                <label class="switch switch-success ms-3">
                                    <input type="checkbox" class="switch-input ready-switch" data-id="${vehicle.id}" ${vehicle.ready ? 'checked' : ''} />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"><i class="icon-base ti tabler-check"></i></span>
                                        <span class="switch-off"><i class="icon-base ti tabler-x"></i></span>
                                    </span>
                                    <span class="switch-label">Ready</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
        });
    }
    function filterVehicles() {
        const brand = document.getElementById('filterBrand').value.trim().toLowerCase();
        const fuel = document.getElementById('filterFuel').value.trim().toLowerCase();
        const body = document.getElementById('filterBody').value.trim().toLowerCase();
        const randomSearch = document.getElementById('randomSearch').value.trim().toLowerCase();
        const filtered = window.allVehicles.filter(vehicle => {
            const matchesBrand = brand ? (vehicle.brand && vehicle.brand.toLowerCase() === brand) : true;
            const matchesFuel = fuel ? (vehicle.fuel && vehicle.fuel.toLowerCase() === fuel) : true;
            const matchesBody = body ? (vehicle.body_type && vehicle.body_type.toLowerCase() === body) : true;
            let matchesRandom = true;
            if (randomSearch) {
                matchesRandom = Object.values(vehicle).some(val =>
                    (val !== null && val !== undefined && val.toString().toLowerCase().includes(randomSearch))
                );
            }
            return matchesBrand && matchesFuel && matchesBody && matchesRandom;
        });
        renderVehicles(filtered);
    }
    const debouncedFilter = debounce(filterVehicles, 300);
    document.getElementById('filterBrand').addEventListener('change', debouncedFilter);
    document.getElementById('filterBody').addEventListener('change', debouncedFilter);
    document.getElementById('filterFuel').addEventListener('change', debouncedFilter);
    document.getElementById('randomSearch').addEventListener('input', debouncedFilter);
    renderVehicles(window.allVehicles);
</script>
<script>
// AJAX toggle switches
function sendToggle(id, field, value) {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const token = tokenMeta ? tokenMeta.getAttribute('content') : null;
    fetch(`/fleet/${id}/switch`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: Object.assign({
            'Content-Type': 'application/json'
        }, token ? { 'X-CSRF-TOKEN': token } : {}),
        body: JSON.stringify({ field, value })
    })
    .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
    })
    .then(data => {
        if (!data.success) alert('Failed to update.');
    })
    .catch(err => {
        console.error('Toggle error:', err);
        alert('Failed to update.');
    });
}

document.querySelectorAll('.visibility-switch').forEach(el => {
    el.addEventListener('change', function() {
        sendToggle(this.dataset.id, 'visibility', this.checked ? 1 : 0);
    });
});
document.querySelectorAll('.available-switch').forEach(el => {
    el.addEventListener('change', function() {
        sendToggle(this.dataset.id, 'status', this.checked ? 1 : 0);
    });
});
document.querySelectorAll('.ready-switch').forEach(el => {
    el.addEventListener('change', function() {
        sendToggle(this.dataset.id, 'ready', this.checked ? 1 : 0);
    });
});
</script>

@endsection