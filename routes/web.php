<?php

use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/vehicles/{category}', [HomeController::class, 'vehicles'])->name('vehicles');
Route::get('/parts/{category}', [HomeController::class, 'parts'])->name('parts');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');



Route::middleware(['auth', 'verified'])->group(function () {

    // AJAX endpoints for Select2 hybrid customer select
    Route::get('/admin/customers/search', [AdminController::class, 'customerSearch'])->name('admin.customers.search');
    Route::post('/admin/customers/quick-create', [AdminController::class, 'quickCreateCustomer'])->name('admin.customers.quick-create');

    // Dashboard: admin and above
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Only admin and above can register new users (but only super can access user management UI)
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Staff and above: manage vehicles, parts, customers, invoices
    Route::group([], function () {
        Route::get('/fleet', [AdminController::class, 'fleet'])->name('fleet');
        Route::get('/addfleet', [AdminController::class, 'addfleet'])->name('addfleet');
        Route::post('/uploadfleet', [AdminController::class, 'uploadfleet'])->name('uploadfleet');
        Route::get('/fleet/{id}/edit', [AdminController::class, 'editfleet'])->name('admin.fleet.edit');
        Route::post('/fleet/{id}/update', [AdminController::class, 'updatefleet'])->name('admin.fleet.update');
        Route::post('/fleet/{id}/switch', [AdminController::class, 'toggleFleetField']);
        Route::get('/fleet/available', [AdminController::class, 'fleetAvailable'])->name('fleet.available');
        Route::get('/fleet/unavailable', [AdminController::class, 'fleetUnavailable'])->name('fleet.unavailable');
        Route::get('/fleet/not-ready', [AdminController::class, 'fleetNotReady'])->name('fleet.notready');
        Route::get('/fleet/running', [AdminController::class, 'fleetRunning'])->name('fleet.running');
        // ...add other staff-accessible routes here (parts, customers, invoices)...
    });




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/addparts', [AdminController::class, 'addparts'])->name('addparts');
    Route::post('/uploadparts', [AdminController::class, 'uploadparts'])->name('uploadparts');

    // User management (super user only) - role check in controller
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::get('/admin/parts', [AdminController::class, 'partsList'])->name('admin.parts.list');
    Route::get('/admin/parts/{id}/edit', [AdminController::class, 'editPart'])->name('admin.parts.edit');
    Route::post('/admin/parts/{id}/update', [AdminController::class, 'updatePart'])->name('admin.parts.update');
    Route::get('/admin/parts/{id}/delete', [AdminController::class, 'deletePart'])->name('admin.parts.delete');
    Route::post('/admin/parts/stock', [AdminController::class, 'adjustStock'])->name('admin.parts.stock');

    // Parts category filters 
    Route::get('/parts/admin/ebike', [AdminController::class, 'partsEbike'])->name('admin.parts.ebike');
    Route::get('/parts/admin/motorcycle', [AdminController::class, 'partsMotorcycle'])->name('admin.parts.motorcycle');
    Route::get('/parts/admin/car', [AdminController::class, 'partsCar'])->name('admin.parts.car');
    Route::get('/parts/admin/other', [AdminController::class, 'partsOther'])->name('admin.parts.other');

    // Parts stock/usage actions
    Route::get('/admin/parts/{id}/restock', [AdminController::class, 'restockForm'])->name('admin.parts.restock.form');
    Route::post('/admin/parts/{id}/restock', [AdminController::class, 'restock'])->name('admin.parts.restock');
    Route::get('/admin/parts/{id}/sell', [AdminController::class, 'sellForm'])->name('admin.parts.sell.form');
    Route::post('/admin/parts/{id}/sell', [AdminController::class, 'sell'])->name('admin.parts.sell');
    Route::get('/admin/parts/sell', [AdminController::class, 'sellForm'])->name('admin.parts.sell.general');
    Route::get('/admin/parts/{id}/transactions', [AdminController::class, 'partTransactions'])->name('admin.parts.transactions');

    // Log history
    Route::get('/admin/log/parts', [AdminController::class, 'partsLog'])->name('admin.parts.log');
    Route::get('/admin/log/vehicles', [AdminController::class, 'vehiclesLog'])->name('admin.vehicles.log');

    // Customer management
    Route::get('/admin/allcustomers', [AdminController::class, 'customerList'])->name('admin.customers.list');
    Route::get('/admin/customers/{id}/show', [AdminController::class, 'showCustomer'])->name('admin.customers.show');
    Route::get('/admin/customers/{id}/view', [AdminController::class, 'viewCustomer'])->name('admin.customers.view');
    
    Route::get('/admin/customers/create', [AdminController::class, 'createCustomer'])->name('admin.customers.create');
    Route::post('/admin/customers/store', [AdminController::class, 'storeCustomer'])->name('admin.customers.store');
    Route::get('/admin/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('admin.customers.edit');
    Route::post('/admin/customers/{id}/update', [AdminController::class, 'updateCustomer'])->name('admin.customers.update');
     Route::delete('/admin/customers/{id}/delete', [AdminController::class, 'deleteCustomer'])->name('admin.customers.delete');
    Route::get('/admin/customers/{id}/vehicles', [AdminController::class, 'customerVehicles'])->name('admin.customers.vehicles');

    // Customer vehicle management
    Route::get('/admin/customers/{customer_id}/vehicles/add', [AdminController::class, 'addVehicle'])->name('admin.customers.vehicles.add');
    Route::post('/admin/customers/{customer_id}/vehicles/store', [AdminController::class, 'storeVehicle'])->name('admin.customers.vehicles.store');
    Route::get('/admin/customers/{customer_id}/vehicles/{vehicle_id}/edit', [AdminController::class, 'editVehicle'])->name('admin.customers.vehicles.edit');
    Route::post('/admin/customers/{customer_id}/vehicles/{vehicle_id}/update', [AdminController::class, 'updateVehicle'])->name('admin.customers.vehicles.update');

    // Service catalog
    Route::get('/admin/services', [AdminController::class, 'serviceList'])->name('admin.services.list');
    Route::get('/admin/services/create', [AdminController::class, 'createService'])->name('admin.services.create');
    Route::post('/admin/services/store', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::get('/admin/services/{id}/edit', [AdminController::class, 'editService'])->name('admin.services.edit');
    Route::post('/admin/services/{id}/update', [AdminController::class, 'updateService'])->name('admin.services.update');

    // Service log entry
    Route::get('/admin/service-log/create', [AdminController::class, 'createServiceLog'])->name('admin.servicelog.create');
    Route::post('/admin/service-log/store', [AdminController::class, 'storeServiceLog'])->name('admin.servicelog.store');
    Route::get('/admin/ajax/customer/{customer_id}/vehicles', [AdminController::class, 'ajaxCustomerVehicles'])->name('admin.ajax.customer.vehicles');
    Route::post('/admin/ajax/customer/{customer_id}/vehicles/quick-create', [AdminController::class, 'quickCreateVehicle'])->name('admin.ajax.customer.vehicles.quick-create');

    // Service entry (multi-service, select by rego, in/out time, print invoice)
    Route::get('/admin/services/entry', [AdminController::class, 'serviceEntry'])->name('admin.services.entry');
    Route::get('/admin/vehicle-lookup', [AdminController::class, 'vehicleLookup'])->name('admin.vehicle.lookup');
    Route::delete('/admin/vehicles/{vehicle_id}/delete', [AdminController::class, 'deleteVehicle'])->name('admin.vehicles.delete');

    // Invoice management
    Route::get('/admin/invoices', [AdminController::class, 'invoiceList'])->name('admin.invoices.list');
    Route::get('/admin/invoices/create', [AdminController::class, 'createInvoice'])->name('admin.invoices.create');
    Route::post('/admin/invoices/store', [AdminController::class, 'storeInvoice'])->name('admin.invoices.store');
    Route::get('/admin/invoices/{id}/show', [AdminController::class, 'showInvoice'])->name('admin.invoices.show');
    Route::get('/admin/invoices/{id}/view', [AdminController::class, 'viewInvoice'])->name('admin.invoices.view');
    Route::get('/admin/invoices/{id}/edit', [AdminController::class, 'editInvoice'])->name('admin.invoices.edit');
    Route::post('/admin/invoices/{id}/update', [AdminController::class, 'updateInvoice'])->name('admin.invoices.update');
    Route::get('/admin/invoices/{id}/print', [AdminController::class, 'printInvoice'])->name('admin.invoices.print');
    Route::get('/admin/invoices/{id}/excel', [AdminController::class, 'exportInvoiceExcel'])->name('admin.invoices.excel');
    Route::post('/admin/invoices/{id}/payment', [AdminController::class, 'recordPayment'])->name('admin.invoices.payment');
    Route::get('/admin/customers/{customer_id}/invoices', [AdminController::class, 'customerInvoices'])->name('admin.invoices.customer');
    Route::delete('/admin/invoices/{id}/delete', [AdminController::class, 'deleteInvoice'])->name('admin.invoices.delete');
    
    // AJAX routes for invoice creation
    Route::get('/admin/ajax/customer/{customer_id}/vehicles', [AdminController::class, 'ajaxCustomerVehicles'])->name('admin.ajax.customer.vehicles');

    // Settings management
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings/update', [AdminController::class, 'updateSettings'])->name('admin.settings.update');

    // Consolidated Invoice management
    Route::get('/admin/consolidated-invoices', [AdminController::class, 'consolidatedInvoiceList'])->name('admin.consolidated-invoices.list');
    Route::get('/admin/consolidated-invoices/create', [AdminController::class, 'createConsolidatedInvoice'])->name('admin.consolidated-invoices.create');
    Route::post('/admin/consolidated-invoices/store', [AdminController::class, 'storeConsolidatedInvoice'])->name('admin.consolidated-invoices.store');
    Route::get('/admin/consolidated-invoices/{id}/show', [AdminController::class, 'showConsolidatedInvoice'])->name('admin.consolidated-invoices.show');
    Route::get('/admin/consolidated-invoices/{id}/view', [AdminController::class, 'viewConsolidatedInvoice'])->name('admin.consolidated-invoices.view');
    Route::get('/admin/consolidated-invoices/{id}/download', [AdminController::class, 'downloadConsolidatedInvoice'])->name('admin.consolidated-invoices.download');
    Route::get('/admin/consolidated-invoices/{id}/print', [AdminController::class, 'printConsolidatedInvoice'])->name('admin.consolidated-invoices.print');
    Route::get('/admin/consolidated-invoices/{id}/excel', [AdminController::class, 'exportConsolidatedInvoiceExcel'])->name('admin.consolidated-invoices.excel');
    Route::post('/admin/consolidated-invoices/{id}/payment', [AdminController::class, 'recordConsolidatedPayment'])->name('admin.consolidated-invoices.payment');
    Route::delete('/admin/consolidated-invoices/{id}/delete', [AdminController::class, 'deleteConsolidatedInvoice'])->name('admin.consolidated-invoices.delete');
    Route::get('/admin/customers/{customer_id}/consolidated-invoices', [AdminController::class, 'customerConsolidatedInvoices'])->name('admin.consolidated-invoices.customer');

    // Team management
    Route::get('/admin/team', [AdminController::class, 'teamList'])->name('admin.team.list');
    Route::get('/admin/team/create', [AdminController::class, 'createTeam'])->name('admin.team.create');
    Route::post('/admin/team/store', [AdminController::class, 'storeTeam'])->name('admin.team.store');
    Route::get('/admin/team/{id}/edit', [AdminController::class, 'editTeam'])->name('admin.team.edit');
    Route::post('/admin/team/{id}/update', [AdminController::class, 'updateTeam'])->name('admin.team.update');
    Route::delete('/admin/team/{id}/delete', [AdminController::class, 'deleteTeam'])->name('admin.team.delete');
    Route::post('/admin/team/{id}/toggle-visibility', [AdminController::class, 'toggleTeamVisibility'])->name('admin.team.toggle-visibility');

    // Owner info management
    Route::get('/admin/owner/edit', [AdminController::class, 'editOwner'])->name('admin.owner.edit');
    Route::post('/admin/owner/update', [AdminController::class, 'updateOwner'])->name('admin.owner.update');

    // Super admin: activity log
    Route::get('/admin/activity-log', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('admin.activitylog');
});

require __DIR__.'/auth.php';

