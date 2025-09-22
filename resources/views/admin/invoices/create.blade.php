@extends('admin.app')

@section('page-title', 'Create Invoice')
@section('pagecss')
<style>
    /* Make the special "Create new customer" option have a white background */
    .customer-select2-dropdown .select2-results__option .new-customer-option {
        display: block;
        background: #ffffff;
        color: #198754; /* Bootstrap success green to match icon */
        border: 1px solid #e5e7eb; /* subtle border */
        border-radius: 6px;
        padding: 8px 10px;
    }
    /* On highlight (keyboard/hover), keep light background */
    .customer-select2-dropdown .select2-results__option.select2-results__option--highlighted .new-customer-option {
        background: #f6ffed; /* very light green tint */
        color: #198754;
    }
    /* Optional: remove default gray focus from option container for this item */
    .customer-select2-dropdown .select2-results__option.select2-results__option--highlighted:has(.new-customer-option) {
        background: transparent;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Create a new invoice for a customer</p>
    </div>
    <div>
        <a href="{{ route('admin.invoices.list') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Back to Invoices
        </a>
    </div>
</div>

<form action="{{ route('admin.invoices.store') }}" method="POST" id="invoiceForm">
        @csrf
        <div class="row">
            <!-- Customer and Vehicle Information -->
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Customer & Vehicle Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_id" class="form-label">Customer *</label>
                                                                <select name="customer_id" id="customer_id" class="form-control" required autocomplete="off" style="width:100%" tabindex="0">
                                                                    @if($selectedCustomer)
                                                                        <option value="{{ $selectedCustomer->id }}" selected>{{ $selectedCustomer->name }} - {{ $selectedCustomer->phone }}</option>
                                                                    @endif
                                                                </select>
                                                                <!-- Modal for quick customer creation (moved outside main form) -->
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="existing_vehicle" class="form-label d-flex align-items-center gap-2">
                                    <span>Existing Vehicle</span>
                                    @if(isset($customerVehicles))
                                        <span class="badge bg-label-primary" id="vehicleCountBadge">{{ $customerVehicles->count() }}</span>
                                    @endif
                                </label>
                                <select id="existing_vehicle" class="form-control" style="width:100%">
                                    <option value="">Select a vehicle for this customer</option>
                                    @if($customerVehicles && $selectedCustomer)
                                        @foreach($customerVehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}" 
                                                    data-registration="{{ $vehicle->registration_number }}"
                                                    data-brand="{{ $vehicle->brand }}"
                                                    data-model="{{ $vehicle->model }}"
                                                    data-year="{{ $vehicle->year }}"
                                                    data-vin="{{ $vehicle->vin }}"
                                                    data-colour="{{ $vehicle->colour }}">
                                                {{ $vehicle->registration_number }} - {{ $vehicle->brand }} {{ $vehicle->model }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <small class="text-muted {{ (isset($customerVehicles) && $customerVehicles->count() === 0) ? '' : 'd-none' }}" id="noVehicleHint">
                                    No vehicles found for this customer — use the dropdown to add one.
                                </small>
                                <!-- Modal for quick vehicle creation (moved outside main form) -->
                            </div>
                        </div>

                        <h6 class="text-secondary mb-3">Vehicle Details</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_registration" class="form-label">Registration Number *</label>
                                <input type="text" name="vehicle_registration" id="vehicle_registration" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_brand" class="form-label">Brand *</label>
                                <input type="text" name="vehicle_brand" id="vehicle_brand" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_model" class="form-label">Model *</label>
                                <input type="text" name="vehicle_model" id="vehicle_model" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_year" class="form-label">Year</label>
                                <input type="number" name="vehicle_year" id="vehicle_year" class="form-control" min="1900" max="{{ date('Y') + 1 }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_vin" class="form-label">VIN</label>
                                <input type="text" name="vehicle_vin" id="vehicle_vin" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="vehicle_colour" class="form-label">Colour</label>
                                <input type="text" name="vehicle_colour" id="vehicle_colour" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Services / Items</h6>
                        <button type="button" class="btn btn-sm btn-success" onclick="addInvoiceItem()">
                            <i class="bx bx-plus"></i> Add Item
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="itemsTable">
                                <thead>
                                    <tr>
                                        <th width="40%">Description</th>
                                        <th width="15%">Qty</th>
                                        <th width="20%">Unit Price</th>
                                        <th width="20%">Total</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsTableBody">
                                    <!-- Items will be added here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-outline-primary" onclick="addInvoiceItem()">
                                <i class="bx bx-plus"></i> Add First Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Invoice Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="invoice_date" class="form-label">Invoice Date *</label>
                            <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}">
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Invoice Totals -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Invoice Totals</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">Subtotal:</div>
                            <div class="col-6 text-end">$<span id="subtotal">0.00</span></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="tax_amount" class="form-label">Tax:</label>
                            </div>
                            <div class="col-6">
                                <input type="number" name="tax_amount" id="tax_amount" class="form-control form-control-sm" step="0.01" min="0" value="0" onchange="calculateTotal()">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="discount_amount" class="form-label">Discount:</label>
                            </div>
                            <div class="col-6">
                                <input type="number" name="discount_amount" id="discount_amount" class="form-control form-control-sm" step="0.01" min="0" value="0" onchange="calculateTotal()">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6"><strong>Total:</strong></div>
                            <div class="col-6 text-end"><strong>$<span id="total">0.00</span></strong></div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card shadow">
                    <div class="card-body">
                        <button type="submit" form="invoiceForm" class="btn btn-primary w-100 mb-2">
                            <i class="bx bx-save"></i> Create Invoice
                        </button>
                        <a href="{{ route('admin.invoices.list') }}" class="btn btn-secondary w-100">
                            <i class="bx bx-x"></i> Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="/assets/js/invoice-customer-hybrid.js?v={{ @filemtime(public_path('assets/js/invoice-customer-hybrid.js')) }}"></script>
@endpush
<script>
let itemCount = 0;

function addInvoiceItem() {
    itemCount++;
    const tbody = document.getElementById('itemsTableBody');
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><input type="text" name="items[${itemCount}][description]" class="form-control" placeholder="Service description" required></td>
        <td><input type="number" name="items[${itemCount}][quantity]" class="form-control quantity" min="1" value="1" onchange="calculateItemTotal(${itemCount})" required></td>
        <td><input type="number" name="items[${itemCount}][unit_price]" class="form-control unit-price" step="0.01" min="0" onchange="calculateItemTotal(${itemCount})" required></td>
        <td><span class="item-total">$0.00</span></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeInvoiceItem(this)"><i class="bx bx-trash"></i></button></td>
    `;
    tbody.appendChild(row);
    
    // Hide the "Add First Item" button if items exist
    if (itemCount === 1) {
        document.querySelector('.text-center button').style.display = 'none';
    }
}

function removeInvoiceItem(button) {
    button.closest('tr').remove();
    calculateTotal();
    
    // Show "Add First Item" button if no items exist
    if (document.querySelectorAll('#itemsTableBody tr').length === 0) {
        document.querySelector('.text-center button').style.display = 'block';
        itemCount = 0;
    }
}

function calculateItemTotal(itemIndex) {
    const row = document.querySelector(`input[name="items[${itemIndex}][quantity]"]`).closest('tr');
    const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
    const unitPrice = parseFloat(row.querySelector('.unit-price').value) || 0;
    const total = quantity * unitPrice;
    
    row.querySelector('.item-total').textContent = `$${total.toFixed(2)}`;
    calculateTotal();
}

function calculateTotal() {
    let subtotal = 0;
    document.querySelectorAll('.item-total').forEach(function(element) {
        const value = parseFloat(element.textContent.replace('$', '')) || 0;
        subtotal += value;
    });
    
    const tax = parseFloat(document.getElementById('tax_amount').value) || 0;
    const discount = parseFloat(document.getElementById('discount_amount').value) || 0;
    const total = subtotal + tax - discount;
    
    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('total').textContent = total.toFixed(2);
}

// Add first item automatically
document.addEventListener('DOMContentLoaded', function() {
    addInvoiceItem();
});
</script>
@endsection

@push('scripts')
<!-- Reinsert modals outside the main invoice form to avoid nested forms -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="createCustomerForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCustomerModalLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newCustomerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="newCustomerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="newCustomerPhone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="newCustomerPhone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="newCustomerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="newCustomerEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="newCustomerAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="newCustomerAddress" name="address">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <div class="modal fade" id="createVehicleModal" tabindex="-1" aria-labelledby="createVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createVehicleForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createVehicleModalLabel">Add New Vehicle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Registration</label>
                                <input type="text" class="form-control" name="registration_number" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Year</label>
                                <input type="number" class="form-control" name="year" min="1900" max="{{ date('Y') + 1 }}" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Model</label>
                                <input type="text" class="form-control" name="model" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">VIN</label>
                                <input type="text" class="form-control" name="vin" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Colour</label>
                                <input type="text" class="form-control" name="colour" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Vehicle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush