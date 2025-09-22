@extends('admin.app')

@section('page-title', 'Parts Inventory')

@section('pagecss')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/css/circular_custom.css') }}" />
<style>
    #parts-card-grid {
        display: flex;
        flex-wrap: wrap;
        margin-left: -12px;
        margin-right: -12px;
    }
    .part-card {
        transition: box-shadow 0.2s, transform 0.2s;
        border-radius: 1rem;
        min-height: 320px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        background: #fff;
    }
    .part-card:hover {
        box-shadow: 0 6px 24px rgba(0,0,0,0.12);
        transform: translateY(-2px) scale(1.01);
    }
    @media (max-width: 767px) {
        #parts-card-grid {
            flex-direction: column;
        }
        .part-card {
            min-height: 0;
        }
        .col-12.col-md-6.col-lg-4 {
            max-width: 100%;
            flex: 0 0 100%;
            padding-left: 0;
            padding-right: 0;
        }
    }
    .part-card .card-body {
        padding: 1.2rem 1.2rem 1rem 1.2rem;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .part-card img, .part-card .bg-light {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 0.5rem;
    }
    .part-card .fw-bold {
        font-size: 1.08rem;
    }
    .part-card .badge {
        font-size: 0.95rem;
        padding: 0.45em 0.8em;
        border-radius: 0.5em;
    }
    .part-card .btn {
        font-size: 0.95rem;
        padding: 0.35em 0.9em;
    }
    .part-card .text-muted.small {
        font-size: 0.93em;
    }
    .part-card .mb-1 {
        margin-bottom: 0.5rem !important;
    }
    .part-card .mb-2 {
        margin-bottom: 0.7rem !important;
    }
    .part-card .mt-2 {
        margin-top: 0.7rem !important;
    }
    .part-card .d-flex.flex-wrap.gap-2 {
        gap: 0.5rem !important;
    }
    .part-card .text-success {
        font-size: 1.08rem;
    }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header d-flex justify-content-between align-items-center">Parts
            <a href="{{ route('addparts') }}" class="btn btn-primary">Add Part</a>
        </h5>
        <div class="card-body">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <div class="mb-3">
                <input type="text" id="parts-search" class="form-control" placeholder="Search parts..." />
            </div>
            <div class="row" id="parts-card-grid">
                @foreach($parts as $part)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 part-card">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-3">
                                @if($part->thumbnail)
                                    <img src="{{ $part->thumbnail }}" alt="thumb" class="rounded border me-3" style="width:80px;height:80px;object-fit:cover;">
                                @else
                                    <div class="bg-light rounded border d-flex align-items-center justify-content-center me-3" style="width:80px;height:80px;">
                                        <span class="text-muted small">No Image</span>
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-bold" style="font-size:1.1rem;font-family:'Poppins',sans-serif;">{{ $part->name }}</div>
                                    <div class="text-muted small">PN: {{ $part->part_number }}</div>
                                    <div class="text-muted small">Make: {{ $part->make }} | Model: {{ $part->model }}</div>
                                </div>
                            </div>
                            <div class="mb-2 flex-grow-1">
                                <div class="mb-1" style="min-height:48px">
                                    @if($part->description)
                                        <span class="text-dark" title="{{ $part->description }}">{{ \Illuminate\Support\Str::limit($part->description, 90) }}</span>
                                    @else
                                        <span class="text-muted">No description</span>
                                    @endif
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-info text-dark">Qty: {{ $part->quantity }}</span>
                                    <span class="fw-bold text-success">${{ number_format($part->price,2) }}</span>
                                </div>
                            </div>
                            <div class="mt-2 d-flex flex-wrap gap-2">
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.parts.edit', $part->id) }}">Edit</a>
                                <a class="btn btn-sm btn-success" href="{{ route('admin.parts.restock.form', $part->id) }}">Restock</a>
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.parts.sell.form', $part->id) }}">Sell/Use</a>
                                <a class="btn btn-sm btn-danger" href="{{ route('admin.parts.delete', $part->id) }}" onclick="return confirm('Delete this part?');">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script>
document.getElementById('parts-search').addEventListener('keyup', function() {
    var value = this.value.toLowerCase();
    var cards = document.querySelectorAll('#parts-card-grid .part-card');
    cards.forEach(function(card) {
        var text = card.textContent.toLowerCase();
        card.parentElement.style.display = text.indexOf(value) > -1 ? '' : 'none';
    });
});
</script>
@endsection
