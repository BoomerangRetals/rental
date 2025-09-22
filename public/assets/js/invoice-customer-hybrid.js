// This script enhances the customer select box on the Create Invoice page to be searchable by name or phone, and allows adding a new customer inline if not found.

$(document).ready(function() {
    function refreshVehiclesForSelectedCustomer() {
        try { console.debug('Refreshing vehicles for customer:', $('#customer_id').val()); } catch(e){}
        $('#existing_vehicle').val(null).trigger('change');
        resetVehicleCountUI();
        initVehicleSelect2();
        setTimeout(function(){
            try { console.debug('Opening vehicle select2 to trigger load'); } catch(e){}
            var $veh = $('#existing_vehicle');
            if ($veh.hasClass('select2-hidden-accessible')) {
                try { $veh.select2('open'); } catch(e){}
            }
        }, 0);
    }
    // Helpers for vehicle count badge and hint
    function ensureVehicleBadge() {
        var $label = $('label[for="existing_vehicle"]');
        var $badge = $('#vehicleCountBadge');
        if ($badge.length === 0 && $label.length) {
            $badge = $('<span id="vehicleCountBadge" class="badge bg-label-primary ms-2" style="display:none;">0</span>');
            $label.append($badge);
        }
        return $badge;
    }

    function setVehicleCount(count) {
        var $badge = ensureVehicleBadge();
        var $hint = $('#noVehicleHint');
        if (count > 0) {
            $badge.text(count).show();
            $hint.hide();
        } else {
            $badge.hide();
            // Show hint only if a customer is selected
            var hasCustomer = !!$('#customer_id').val();
            if (hasCustomer) {
                $hint.show();
            } else {
                $hint.hide();
            }
        }
    }

    function resetVehicleCountUI() {
        var $badge = ensureVehicleBadge();
        $badge.hide();
        $('#noVehicleHint').hide();
    }
    // Replace the select with a select2 hybrid, minimumInputLength: 1 for instant search
    $('#customer_id').select2({
        placeholder: 'Type name or phone to search customer',
        allowClear: true,
        width: '100%',
        minimumInputLength: 1,
        ajax: {
            url: '/admin/customers/search',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function(data) {
                let results = data.results;
                // Add a special option to create a new customer if not found
                if (data.can_create && data.query) {
                    results.push({
                        id: 'create_new',
                        text: 'Add new customer: ' + data.query,
                        isNew: true
                    });
                }
                return {
                    results: results
                };
            },
            cache: true
        },
        templateResult: function(data) {
            if (data.isNew) {
                return $('<span class="new-customer-option"><i class="ti ti-user-plus me-1 text-success"></i> ' + data.text + '</span>');
            }
            return data.text;
        },
        // Hide dropdown until user types
        dropdownCssClass: 'customer-select2-dropdown',
        language: {
            inputTooShort: function() {
                return 'Type at least 1 character to search';
            },
            noResults: function() {
                return 'No customers found';
            }
        }
    });

    // Handle selection of 'create new customer'
    $('#customer_id').on('select2:select', function(e) {
        var data = e.params.data;
        if (data.isNew) {
            // Show modal to create new customer
            $('#createCustomerModal').modal('show');
            $('#newCustomerPhone').val(data.text.replace('Add new customer: ', ''));
            // Reset select2
            $('#customer_id').val(null).trigger('change');
        }
    });

    // Handle new customer form submission
    $('#createCustomerForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: '/admin/customers/quick-create',
            method: 'POST',
            data: form.serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success && response.customer) {
                    // Add new customer to select2 and select it
                    var newOption = new Option(response.customer.name + ' - ' + response.customer.phone, response.customer.id, true, true);
                    $('#customer_id').append(newOption).trigger('change');
                    $('#createCustomerModal').modal('hide');
                } else {
                    alert('Failed to create customer.');
                }
            },
            error: function() {
                alert('Failed to create customer.');
            }
        });
    });

    // Vehicle Select2: depends on selected customer
    function initVehicleSelect2() {
        var $veh = $('#existing_vehicle');
        if (!$veh.length) return;
        if ($veh.hasClass('select2-hidden-accessible')) {
            try { $veh.select2('destroy'); } catch(e){}
        }
        $veh.select2({
            placeholder: 'Select a vehicle for this customer',
            allowClear: true,
            width: '100%',
            minimumInputLength: 0,
            ajax: {
                delay: 0,
                transport: function (params, success, failure) {
                    const customerId = $('#customer_id').val();
                    if (!customerId || customerId === 'create_new') {
                        // No customer selected; return empty
                        success({ results: [] });
                        return;
                    }
                    const url = '/admin/ajax/customer/' + encodeURIComponent(customerId) + '/vehicles';
                    const term = (params && params.data && typeof params.data.term !== 'undefined') ? (params.data.term || '') : '';
                    try { console.debug('Vehicle AJAX transport start:', { url, term, customerId }); } catch(e){}
                    const request = $.ajax({
                        url: url,
                        dataType: 'json',
                        data: { q: term }
                    });
                    request.then(function(data){
                        try { console.debug('Vehicle AJAX success:', { url, term, count: (data && data.results) ? data.results.length : 0 }); } catch(e){}
                        success(data);
                    });
                    request.fail(function(jqXHR, textStatus, errorThrown){
                        try { console.error('Vehicle AJAX error:', { url, term, textStatus, error: errorThrown, response: jqXHR && jqXHR.responseText }); } catch(e){}
                        failure(jqXHR, textStatus, errorThrown);
                    });
                    return request;
                },
                processResults: function(data, params) {
                    let results = data.results || [];
                    // Update count when no term (initial open/load)
                    var term = (params && params.term) ? params.term : '';
                    if (!term) {
                        // results length before adding any synthetic options
                        setVehicleCount(results.length);
                    }
                    if (data.can_create) {
                        // personalize option label with customer name/phone if available in the select2 text
                        var customerText = $('#customer_id').find(':selected').text() || 'this customer';
                        results.push({
                            id: 'create_new_vehicle',
                            text: 'Add vehicle for ' + customerText,
                            isNewVehicle: true
                        });
                    }
                    return { results: results };
                },
                cache: true
            },
            templateResult: function(data) {
                if (data.isNewVehicle) {
                    return $('<span class="new-customer-option"><i class="ti ti-car me-1 text-success"></i> ' + data.text + '</span>');
                }
                return data.text;
            }
        });
    }

    // Initialize vehicle select2 on load and whenever customer changes
    initVehicleSelect2();
    // If a customer is already selected on page load (e.g., after redirect), open the vehicle dropdown
    var initialCustomer = $('#customer_id').val();
    if (initialCustomer && initialCustomer !== 'create_new') {
        // Reset badge/hint and open to fetch results
        resetVehicleCountUI();
        setTimeout(function(){
            var $veh = $('#existing_vehicle');
            if ($veh.hasClass('select2-hidden-accessible')) {
                try { $veh.select2('open'); } catch(e){}
            }
        }, 0);
    }
    $('#customer_id').on('change', function() {
        try { console.debug('Customer changed for invoice (change):', $('#customer_id').val()); } catch(e){}
        refreshVehiclesForSelectedCustomer();
    });
    $('#customer_id').on('select2:select', function() {
        try { console.debug('Customer changed for invoice (select2:select):', $('#customer_id').val()); } catch(e){}
        refreshVehiclesForSelectedCustomer();
    });

    // When a vehicle is chosen or creation is triggered
    $('#existing_vehicle').on('select2:select', function(e) {
        var data = e.params.data;
        if (data.isNewVehicle) {
            // Show modal to create new vehicle
            $('#createVehicleModal').modal('show');
            // Reset selection
            $('#existing_vehicle').val(null).trigger('change');
        } else {
            // Fill vehicle fields from selected data if present
            if (data.registration_number) $('#vehicle_registration').val(data.registration_number);
            if (data.brand) $('#vehicle_brand').val(data.brand);
            if (data.model) $('#vehicle_model').val(data.model);
            if (data.year) $('#vehicle_year').val(data.year);
            if (data.vin) $('#vehicle_vin').val(data.vin);
            if (data.colour) $('#vehicle_colour').val(data.colour);
        }
    });

    // Handle quick-create vehicle submission
    $('#createVehicleForm').on('submit', function(e) {
        e.preventDefault();
        const customerId = $('#customer_id').val();
        if (!customerId || customerId === 'create_new') {
            alert('Please select a customer first.');
            return;
        }
        $.ajax({
            url: '/admin/ajax/customer/' + encodeURIComponent(customerId) + '/vehicles/quick-create',
            method: 'POST',
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                if (response.success && response.vehicle) {
                    // Select this vehicle and fill fields
                    var v = response.vehicle;
                    var newOption = new Option(v.text, v.id, true, true);
                    $('#existing_vehicle').append(newOption).trigger('change');
                    $('#vehicle_registration').val(v.registration_number || '');
                    $('#vehicle_brand').val(v.brand || '');
                    $('#vehicle_model').val(v.model || '');
                    $('#vehicle_year').val(v.year || '');
                    $('#vehicle_vin').val(v.vin || '');
                    $('#vehicle_colour').val(v.colour || '');
                    // Increment badge count and hide hint
                    var current = parseInt($('#vehicleCountBadge').text(), 10);
                    if (isNaN(current)) current = 0;
                    setVehicleCount(current + 1);
                    $('#createVehicleModal').modal('hide');
                    $('#createVehicleForm')[0].reset();
                } else {
                    alert('Failed to create vehicle.');
                }
            },
            error: function() {
                alert('Failed to create vehicle.');
            }
        });
    });
});
