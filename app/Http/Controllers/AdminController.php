<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\CustomerVehicle;
use App\Models\Part;
use App\Models\PartSalesLog;
use App\Models\User;
use App\Models\PartTransaction;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ServiceLog;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Setting;
use App\Models\ConsolidatedInvoice;

use App\Models\Team;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * AJAX: Search customers for Select2 hybrid select (by name or phone)
     * GET /admin/customers/search?term=...
     * Returns: [{id, text}]
     */
    public function customerSearch(Request $request)
    {
        $query = $request->input('q', $request->input('term', ''));
        $results = [];
        if (strlen($query) > 0) {
            $customers = \App\Models\Customer::where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->limit(20)
            ->get();
            foreach ($customers as $customer) {
                $label = $customer->name;
                if ($customer->phone) {
                    $label .= ' (' . $customer->phone . ')';
                }
                $results[] = [
                    'id' => $customer->id,
                    'text' => $label
                ];
            }
        }
        // For Select2: allow quick-create if no results match
        $can_create = (strlen($query) > 0 && count($results) === 0);
        return response()->json([
            'results' => $results,
            'can_create' => $can_create,
            'query' => $query,
        ]);
    }

    /**
     * AJAX: Quick-create customer for Select2 hybrid select
     * POST /admin/customers/quick-create
     * Accepts: name, phone, email, address
     * Returns: {id, text} for Select2
     */
    public function quickCreateCustomer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
        ]);
        $customer = \App\Models\Customer::create($validated);
        return response()->json([
            'success' => true,
            'customer' => [
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
            ],
        ]);
    }
    /**
     * Log an activity for the current user
     */
    protected function logActivity($action, $modelType, $modelId, $description = null)
    {
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
            'ip_address' => request()->ip(),
        ]);
    }
    public function dashboard()
    {
        $totalVehicles = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 1)->count();
        $rentedVehicles = Vehicle::where('status', 1)->where('ready', 0)->count();
        $soldVehicles = Vehicle::where('reference', 'sold')->count();
        $rentedRevenue = Vehicle::where('status', 1)->where('ready', 0)->sum('weekly');
        $soldRevenue = Vehicle::where('reference', 'sold ')->sum('weekly');

        $totalStock = Part::sum('quantity');
        $soldQty = PartTransaction::where('type', 'sell')->sum('quantity');
        $soldRevenue = PartTransaction::where('type', 'sell')->sum(DB::raw('quantity * price'));
        $usedQty = PartTransaction::where('type', 'use')->sum('quantity');
        $usedCost = PartTransaction::where('type', 'use')->sum(DB::raw('quantity * cost'));
        $restockedQty = PartTransaction::where('type', 'restock')->sum('quantity');
        $restockedCost = PartTransaction::where('type', 'restock')->sum(DB::raw('quantity * cost'));
        $partsProfit = $soldRevenue - $usedCost;
        // Add total cost of parts used (own)
        $ownUsedCost = PartSalesLog::where('type', 'use')->sum(DB::raw('quantity * cost'));

        // New stats
        $lowStockCount = Part::whereColumn('quantity', '<', 'reorder_level')->count();
        $totalPartTypes = Part::count();
        $mostUsed = PartTransaction::where('type', 'use')
            ->select('part_id', DB::raw('SUM(quantity) as total_used'))
            ->groupBy('part_id')->orderByDesc('total_used')->first();
        $mostUsedPart = $mostUsed ? Part::find($mostUsed->part_id)?->name : null;
        $mostSold = PartTransaction::where('type', 'sell')
            ->select('part_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('part_id')->orderByDesc('total_sold')->first();
        $mostSoldPart = $mostSold ? Part::find($mostSold->part_id)?->name : null;
        $inventoryValue = Part::sum(DB::raw('quantity * cost'));

        $vehiclesOnRoute = Vehicle::where('status', 1)->where('status', 0)->count();
        $underRepairVehicles = Vehicle::where('status', 0)->where('ready', 1)->count();
        $deadVehicles = Vehicle::where('status', 0)->where('ready', 0)->count();

        // --- Today's Payments ---
        $today = now()->toDateString();
        $todaysCashPayments = Invoice::whereDate('paid_at', $today)
            ->where('payment_status', '!=', 'unpaid')
            ->where('payment_method', 'cash')
            ->sum('paid_amount');
        $todaysOtherPayments = Invoice::whereDate('paid_at', $today)
            ->where('payment_status', '!=', 'unpaid')
            ->where('payment_method', '!=', 'cash')
            ->sum('paid_amount');

        // Today's Unpaid Amount: sum of balance due for invoices dated today that are unpaid or partial
        $todaysUnpaidAmount = Invoice::whereDate('invoice_date', $today)
            ->whereIn('payment_status', ['unpaid', 'partial'])
            ->sum('balance_due');

        return view('admin.dashboard', [
            'totalVehicles' => $totalVehicles,
            'availableVehicles' => $availableVehicles,
            'rentedVehicles' => $rentedVehicles,
            'soldVehicles' => $soldVehicles,
            'rentedRevenue' => $rentedRevenue,
            'soldRevenue' => $soldRevenue,
            'totalStock' => $totalStock,
            'soldQty' => $soldQty,
            'usedQty' => $usedQty,
            'usedCost' => $usedCost,
            'restockedQty' => $restockedQty,
            'restockedCost' => $restockedCost,
            'partsProfit' => $partsProfit,
            'ownUsedCost' => $ownUsedCost,
            'lowStockCount' => $lowStockCount,
            'totalPartTypes' => $totalPartTypes,
            'mostUsedPart' => $mostUsedPart,
            'mostSoldPart' => $mostSoldPart,
            'inventoryValue' => $inventoryValue,
            'vehiclesOnRoute' => $vehiclesOnRoute,
            'underRepairVehicles' => $underRepairVehicles,
            'deadVehicles' => $deadVehicles,
            'todaysCashPayments' => $todaysCashPayments,
            'todaysOtherPayments' => $todaysOtherPayments,
            'todaysUnpaidAmount' => $todaysUnpaidAmount,
        ]);
    }

    public function fleet()
    {
        $vehicles = Vehicle::all();
        return view('admin.fleet', compact('vehicles'));
    }
    public function addfleet()
    {
        
        return view('admin.addfleet');
    }
    public function uploadfleet(Request $request)
    {
        // Validate first
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'nullable|string|max:255',
            'vin_number' => 'required|string|max:255',
            'colour' => 'nullable|string|max:100',
            'seats' => 'nullable|integer|min:1|max:100',
            'doors' => 'nullable|integer|min:1|max:10',
            'weekly' => 'nullable|integer|min:0',
            'transmission' => 'nullable|string|max:100',
            'fuel_type' => 'nullable|string|max:100',
            'body_type' => 'nullable|string|max:100',
            'engine_number' => 'nullable|string|max:100',
            'series' => 'nullable|string|max:100',
            'reference' => 'nullable|string|max:100',
            'tracker' => 'nullable',
            'tracker_details' => 'nullable|string|max:255',
            'bond' => 'nullable|integer|min:0',
            'fleet_type' => 'nullable|string|max:100',
            'visibility' => 'nullable|boolean',
            'terms' => 'nullable|array',
            'terms.*' => 'string',
            'fleet_pictures.*' => 'nullable|image|max:2048',
            'fleet_thumbnail' => 'required|image|max:2048',
            'status' => 'nullable|boolean',
            'listing_type' => 'required|string',
            'sell_price' => 'nullable|integer|min:0',
        ]);

        try {
            // Upload thumbnail
            $thumbnailUrl = Cloudinary::uploadApi()->upload($request->file('fleet_thumbnail')->getRealPath());
            $thumbnail = $thumbnailUrl['secure_url'] ?? null;
            // Upload fleet pictures
            $uploadedUrls = [];
            if ($request->hasFile('fleet_pictures')) {
                foreach ($request->file('fleet_pictures') as $photo) {
                    $uploadedFileUrl = Cloudinary::uploadApi()->upload($photo->getRealPath());
                    $uploadedUrls[] = $uploadedFileUrl['secure_url'] ?? null;
                }
            }
            // Save vehicle data
            $vehicle = new Vehicle();
            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->year = $request->year;
            $vehicle->registration_number = $request->registration_number;
            $vehicle->vin = $request->vin_number;
            $vehicle->colour = $request->colour;
            $vehicle->seats = $request->seats;
            $vehicle->doors = $request->doors;
            if ($request->listing_type === 'rent') {
                $vehicle->weekly = $request->weekly;
            } else if ($request->listing_type === 'sell') {
                $vehicle->weekly = $request->sell_price;
            }
            $vehicle->transmission = $request->transmission;
            $vehicle->fuel = $request->fuel_type;
            $vehicle->body_type = $request->body_type;
            $vehicle->engine_no = $request->engine_number;
            $vehicle->series = $request->series;
            $vehicle->reference = $request->listing_type;
            $vehicle->tracker = $request->tracker ? 1 : 0;
            $vehicle->tracker_details = $request->tracker_details;
            $vehicle->bond = $request->bond;
            $vehicle->thumbnail = $thumbnail;
            $vehicle->vehicle_type = $request->fleet_type;
            $vehicle->visibility = $request->has('visible') ? 1 : 0;
            $vehicle->terms = $request->has('terms') ? json_encode($request->terms) : null;
            $vehicle->images = json_encode($uploadedUrls);
            $vehicle->status = $request->has('available') ? 1 : 0;
            $vehicle->ready = $request->has('ready') ? 1 : 0;
            $vehicle->save();
            $this->logActivity('create', 'Vehicle', $vehicle->id, 'Created vehicle: ' . $vehicle->brand . ' ' . $vehicle->model);
            return redirect()->route('addfleet')->with('success', 'Fleet added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function toggleFleetField(Request $request, $id)
    {
        $request->validate([
            'field' => 'required|in:visibility,status,ready',
            'value' => 'required|in:0,1',
        ]);
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->{$request->field} = $request->value;
        $vehicle->save();
        return response()->json(['success' => true]);
    }
    public function editfleet($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.editfleet', compact('vehicle'));
    }

    public function updatefleet(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'nullable|string|max:255',
            'vin' => 'required|string|max:255',
            'colour' => 'nullable|string|max:100',
            'seats' => 'nullable|integer|min:1|max:100',
            'doors' => 'nullable|integer|min:1|max:10',
            'weekly' => 'nullable|integer|min:0',
            'transmission' => 'nullable|string|max:100',
            'fuel' => 'nullable|string|max:100',
            'body_type' => 'nullable|string|max:100',
            'engine_no' => 'nullable|string|max:100',
            'series' => 'nullable|string|max:100',
            'reference' => 'nullable|string|max:100',
            'tracker' => 'nullable',
            'tracker_details' => 'nullable|string|max:255',
            'bond' => 'nullable|integer|min:0',
            'vehicle_type' => 'nullable|string|max:100',
            'visibility' => 'nullable|boolean',
            'terms' => 'nullable|array',
            'terms.*' => 'string',
            'thumbnail' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
            'ready' => 'nullable|boolean',
        ]);
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->registration_number = $request->registration_number;
        $vehicle->vin = $request->vin;
        $vehicle->colour = $request->colour;
        $vehicle->seats = $request->seats;
        $vehicle->doors = $request->doors;
        $vehicle->weekly = $request->weekly;
        $vehicle->transmission = $request->transmission;
        $vehicle->fuel = $request->fuel;
        $vehicle->body_type = $request->body_type;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->series = $request->series;
        $vehicle->reference = $request->reference;
        $vehicle->tracker = $request->tracker ? 1 : 0;
        $vehicle->tracker_details = $request->tracker_details;
        $vehicle->bond = $request->bond;
        $vehicle->vehicle_type = $request->vehicle_type;
        $vehicle->visibility = $request->has('visibility') ? 1 : 0;
        $vehicle->status = $request->has('status') ? 1 : 0;
        $vehicle->ready = $request->has('ready') ? 1 : 0;
        if ($request->hasFile('thumbnail')) {
            $thumbnailUrl = Cloudinary::uploadApi()->upload($request->file('thumbnail')->getRealPath());
            $vehicle->thumbnail = $thumbnailUrl['secure_url'] ?? $vehicle->thumbnail;
        }
        if ($request->hasFile('images')) {
            $uploadedUrls = [];
            foreach ($request->file('images') as $photo) {
                $uploadedFileUrl = Cloudinary::uploadApi()->upload($photo->getRealPath());
                $uploadedUrls[] = $uploadedFileUrl['secure_url'] ?? null;
            }
            $vehicle->images = json_encode($uploadedUrls);
        }
        if ($request->has('terms')) {
            $vehicle->terms = json_encode($request->terms);
        }
    $vehicle->save();
    $this->logActivity('update', 'Vehicle', $vehicle->id, 'Updated vehicle: ' . $vehicle->brand . ' ' . $vehicle->model);
    return redirect()->route('admin.fleet.edit', $vehicle->id)->with('success', 'Fleet updated successfully!');
    }
    public function fleetAvailable()
    {
        $vehicles = Vehicle::where('status', 1)->get();
        return view('admin.fleet', compact('vehicles'));
    }

    public function fleetUnavailable()
    {
        $vehicles = Vehicle::where('status', 0)->get();
        return view('admin.fleet', compact('vehicles'));
    }

    public function fleetNotReady()
    {
        $vehicles = Vehicle::where('ready', 0)->get();
        return view('admin.fleet', compact('vehicles'));
    }

    public function fleetRunning()
    {
        $vehicles = Vehicle::where('status', 1)->where('ready', 1)->get();
        return view('admin.fleet', compact('vehicles'));
    }
    public function addparts()
    {
        $makes = Part::whereNotNull('make')->pluck('make')->unique()->sort()->values();
        $models = Part::whereNotNull('model')->pluck('model')->unique()->sort()->values();
        return view('admin.addparts', compact('makes', 'models'));
    }

    public function uploadparts(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'part_number' => 'nullable|string|max:255',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'quantity' => 'nullable|integer|min:0',
            'cost' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
            'type' => 'nullable|string|max:255',
            'visibility' => 'nullable|boolean',
            'supplier' => 'nullable|string|max:255',
            'reorder_level' => 'nullable|integer|min:0',
            'thumbnail' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048',
        ]);

        try {
            $thumbnail = null;
            if ($request->hasFile('thumbnail')) {
                $uploaded = Cloudinary::uploadApi()->upload($request->file('thumbnail')->getRealPath());
                $thumbnail = $uploaded['secure_url'] ?? null;
            }

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    $uploaded = Cloudinary::uploadApi()->upload($img->getRealPath());
                    $images[] = $uploaded['secure_url'] ?? null;
                }
            }

            $part = Part::create([
                'name' => $request->name,
                'description' => $request->description,
                'part_number' => $request->part_number,
                'make' => $request->make,
                'model' => $request->model,
                'year' => $request->year,
                'quantity' => $request->quantity ?? 0,
                'cost' => $request->cost ?? 0,
                'price' => $request->price ?? 0,
                'status' => $request->has('status') ? 1 : 0,
                'type' => $request->type,
                'visibility' => $request->has('visibility') ? 1 : 0,
                'supplier' => $request->supplier,
                'reorder_level' => $request->reorder_level ?? 0,
                'thumbnail' => $thumbnail,
                'images' => $images,
            ]);

            $this->logActivity('create', 'Part', $part->id, 'Created part: ' . $part->name);
            return redirect()->route('addparts')->with('success', 'Part added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    public function partsList()
    {
        $parts = Part::orderBy('name')->get();
        return view('admin.parts', compact('parts'));
    }

    public function editPart($id)
    {
        $part = Part::findOrFail($id);
        $makes = Part::whereNotNull('make')->pluck('make')->unique()->sort()->values();
        $models = Part::whereNotNull('model')->pluck('model')->unique()->sort()->values();
        return view('admin.editparts', compact('part', 'makes', 'models'));
    }

    public function updatePart(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'part_number' => 'nullable|string|max:255',
            'make' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'quantity' => 'nullable|integer|min:0',
            'cost' => 'nullable|numeric|min:0',
            'price' => 'nullable|numeric|min:0',
            'status' => 'nullable|boolean',
            'type' => 'nullable|string|max:255',
            'visibility' => 'nullable|boolean',
            'supplier' => 'nullable|string|max:255',
            'reorder_level' => 'nullable|integer|min:0',
        ]);
        $part = Part::findOrFail($id);
        $part->name = $request->name;
        $part->description = $request->description;
        $part->part_number = $request->part_number;
        $part->make = $request->make;
        $part->model = $request->model;
        $part->year = $request->year;
        $part->quantity = $request->quantity;
        $part->cost = $request->cost;
        $part->price = $request->price;
        $part->status = $request->has('status') ? 1 : 0;
        $part->type = $request->type;
        $part->visibility = $request->has('visibility') ? 1 : 0;
        $part->supplier = $request->supplier;
        $part->reorder_level = $request->reorder_level;
    $part->save();
    $this->logActivity('update', 'Part', $part->id, 'Updated part: ' . $part->name);
    return redirect()->route('admin.parts.edit', $part->id)->with('success', 'Part updated successfully');
    }

    public function deletePart($id)
    {
        $part = Part::findOrFail($id);
    $part->delete();
    $this->logActivity('delete', 'Part', $part->id, 'Deleted part: ' . $part->name);
    return redirect()->route('admin.parts.list')->with('success', 'Part deleted');
    }

    public function adjustStock(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:parts,id',
            'adjustment' => 'required|integer',
        ]);
        $part = Part::findOrFail($request->input('id'));
        $part->quantity = max(0, $part->quantity + (int)$request->adjustment);
        $part->save();
        return redirect()->route('admin.parts.edit', $part->id)->with('success', 'Stock adjusted');
    }
    public function partsEbike()
    {
        $parts = Part::where('type', 'e-bike')->orderBy('name')->get();
        return view('admin.parts', compact('parts'));
    }

    public function partsMotorcycle()
    {
        $parts = Part::where('type', 'motorcycle')->orderBy('name')->get();
        return view('admin.parts', compact('parts'));
    }

    public function partsCar()
    {
        $parts = Part::where('type', 'car')->orderBy('name')->get();
        return view('admin.parts', compact('parts'));
    }

    public function partsOther()
    {
        $parts = Part::where('type', 'other')->orderBy('name')->get();
        return view('admin.parts', compact('parts'));
    }
    
    // Show restock form
    public function restockForm($id)
    {
        $part = Part::findOrFail($id);
        return view('admin.restockpart', compact('part'));
    }

    // Handle restock
    public function restock(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        $part = Part::findOrFail($id);
        $part->quantity += $request->quantity;
        $part->cost = $request->cost; // Optionally update average cost
        $part->save();
        PartTransaction::create([
            'part_id' => $part->id,
            'type' => 'restock',
            'quantity' => $request->quantity,
            'cost' => $request->cost,
            'notes' => $request->notes,
        ]);
        return redirect()->route('admin.parts.list')->with('success', 'Part restocked successfully.');
    }

    // Show sell/use form
    public function sellForm($id = null)
    {
        $part = $id ? Part::findOrFail($id) : null;
        
        $parts = Part::orderBy('name')->get();
        
        $staff = Team::orderBy('name')->get();
        return view('admin.sellpart', compact('part', 'parts', 'staff'));
    }

    // Handle sell/use
    public function sell(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:sell,use',
            'price' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'staff_id' => 'nullable|integer|exists:teams,id',
        ]);
        $part = Part::findOrFail($id);
        if ($part->quantity < $request->quantity) {
            return back()->with('error', 'Not enough stock.');
        }
        $part->quantity -= $request->quantity;
        $part->save();
        PartTransaction::create([
            'part_id' => $part->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'cost' => $part->cost,
            'price' => $request->type == 'sell' ? $request->price : null,
            'notes' => $request->notes,
        ]);
        // Log in part_sales_logs
         PartSalesLog::create([
            'user_id' => auth()->id(),
            'staff_id' => $request->staff_id,
            'part_id' => $part->id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'cost' => $part->cost,
            'price' => $request->type == 'sell' ? $request->price : null,
            'notes' => $request->notes,
        ]);
        return redirect()->route('admin.parts.list')->with('success', 'Part stock updated.');
    }

    // Show part transaction history
    public function partTransactions($id)
    {
        $part = Part::findOrFail($id);
        $transactions = PartTransaction::where('part_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.parttransactions', compact('part', 'transactions'));
    }

    public function partsLog(Request $request)
    {
        $range = $request->input('range', 'daily');
        $query = PartSalesLog::with(['part', 'user', 'staff']);
        if ($range === 'daily') {
            $query->whereDate('created_at', today());
        } elseif ($range === 'weekly') {
            $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($range === 'monthly') {
            $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
        }
        $logs = $query->orderByDesc('created_at')->get();
        return view('admin.partslog', compact('logs', 'range'));
    }

    public function vehiclesLog(Request $request)
    {
        // Placeholder: implement vehicle log logic as needed
        $range = $request->input('range', 'daily');
        $logs = collect(); // Replace with actual vehicle log query
        return view('admin.vehicleslog', compact('logs', 'range'));
    }
    // Customer management
    public function customerList(Request $request) {
        $query = Customer::orderBy('name');
        if ($request->has('search') && trim($request->search) !== '') {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        $customers = $query->get();
        return view('admin.customers', compact('customers'));
    }

    public function viewCustomer($id) {
        $customer = Customer::findOrFail($id);
        $customerVehicles = CustomerVehicle::where('customer_id', $id)->get();
        
        // Get customer statistics
        $totalVehicles = $customerVehicles->count();
        $totalInvoices = Invoice::where('customer_id', $id)->count();
        $unpaidAmount = Invoice::where('customer_id', $id)
                              ->whereIn('payment_status', ['unpaid', 'partial'])
                              ->sum('balance_due');
        $totalPaid = Invoice::where('customer_id', $id)->sum('paid_amount');
        
        // Get recent invoices (last 10)
        $recentInvoices = Invoice::where('customer_id', $id)
                                ->with(['customerVehicle', 'items'])
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();
        
        // Attach vehicles to customer for the view
        $customer->vehicles = $customerVehicles;
        
        return view('admin.customer-profile', compact('customer', 'totalVehicles', 'totalInvoices', 'recentInvoices', 'unpaidAmount', 'totalPaid'));
    }

    public function showCustomer($id) {
        $customer = Customer::findOrFail($id);
        $customerVehicles = CustomerVehicle::where('customer_id', $id)->get();
        
        // Get customer statistics
        $totalVehicles = $customerVehicles->count();
        $totalInvoices = Invoice::where('customer_id', $id)->count();
        $unpaidAmount = Invoice::where('customer_id', $id)
                              ->whereIn('payment_status', ['unpaid', 'partial'])
                              ->sum('balance_due');
        $totalPaid = Invoice::where('customer_id', $id)->sum('paid_amount');
        
        // Get recent invoices (last 10)
        $recentInvoices = Invoice::where('customer_id', $id)
                                ->with(['customerVehicle', 'items'])
                                ->orderBy('created_at', 'desc')
                                ->take(10)
                                ->get();
        
        // Attach vehicles to customer for the view
        $customer->vehicles = $customerVehicles;
        
        return view('admin.customers.show', compact('customer', 'totalVehicles', 'totalInvoices', 'recentInvoices', 'unpaidAmount', 'totalPaid'));
    }

    public function createCustomer() {
        return view('admin.createcustomer');
    }
    public function storeCustomer(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);
        Customer::create($request->only(['name','email','phone','address']));
        return redirect()->route('admin.customers.list')->with('success', 'Customer added!');
    }
    public function editCustomer($id) {
        $customer = Customer::findOrFail($id);
        return view('admin.editcustomer', compact('customer'));
    }
    public function updateCustomer(Request $request, $id) {
        $customer = Customer::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);
        $customer->update($request->only(['name','email','phone','address']));
        return redirect()->route('admin.customers.list')->with('success', 'Customer updated!');
    }
    
    public function deleteCustomer($id) {
        $customer = Customer::findOrFail($id);
        
        // Soft delete customer vehicles first
        CustomerVehicle::where('customer_id', $id)->update(['active' => false]);
        
        // Delete the customer
        $customer->delete();
        
        return redirect()->route('admin.customers.list')->with('success', 'Customer deleted successfully!');
    }
    public function customerVehicles($id) {
        $customer = Customer::findOrFail($id);
        $vehicles = CustomerVehicle::where('customer_id', $id)->where('active', true)->get();
        return view('admin.customervehicles', compact('customer','vehicles'));
    }

    // Add vehicle for customer
    public function addVehicle($customer_id) {
        $customer = Customer::findOrFail($customer_id);
        return view('admin.addvehicle', compact('customer'));
    }
    public function storeVehicle(Request $request, $customer_id) {
        $customer = Customer::findOrFail($customer_id);
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'nullable|string|max:255',
            'vin' => 'required|string|max:255',
            'colour' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'fuel' => 'nullable|string|max:255',
            'body_type' => 'nullable|string|max:255',
            'engine_no' => 'nullable|string|max:255',
            'odometer_reading' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $vehicle = new CustomerVehicle($request->only([
            'brand', 'model', 'year', 'registration_number', 'vin',
            'colour', 'transmission', 'fuel', 'body_type', 'engine_no',
            'odometer_reading', 'notes'
        ]));
        $vehicle->customer_id = $customer->id;
        $vehicle->save();
        
        return redirect()->route('admin.customers.vehicles', $customer->id)->with('success', 'Vehicle added!');
    }
    public function editVehicle($customer_id, $vehicle_id) {
        $customer = Customer::findOrFail($customer_id);
        $vehicle = CustomerVehicle::findOrFail($vehicle_id);
        return view('admin.editvehicle', compact('customer','vehicle'));
    }
    public function updateVehicle(Request $request, $customer_id, $vehicle_id) {
        $customer = Customer::findOrFail($customer_id);
        $vehicle = CustomerVehicle::findOrFail($vehicle_id);
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'nullable|string|max:255',
            'vin' => 'required|string|max:255',
            'colour' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'fuel' => 'nullable|string|max:255',
            'body_type' => 'nullable|string|max:255',
            'engine_no' => 'nullable|string|max:255',
            'odometer_reading' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        $vehicle->update($request->only([
            'brand', 'model', 'year', 'registration_number', 'vin',
            'colour', 'transmission', 'fuel', 'body_type', 'engine_no',
            'odometer_reading', 'notes'
        ]));
        
        return redirect()->route('admin.customers.vehicles', $customer->id)->with('success', 'Vehicle updated!');
    }

    // Service catalog
    public function serviceList() {
        $services = Service::orderBy('name')->get();
        return view('admin.services', compact('services'));
    }
    public function createService() {
        return view('admin.createservice');
    }
    public function storeService(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        Service::create($request->only(['name','price']));
        return redirect()->route('admin.services.list')->with('success', 'Service added!');
    }
    public function editService($id) {
        $service = Service::findOrFail($id);
        return view('admin.editservice', compact('service'));
    }
    public function updateService(Request $request, $id) {
        $service = Service::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
        $service->update($request->only(['name','price']));
        return redirect()->route('admin.services.list')->with('success', 'Service updated!');
    }

    // Service log entry
    public function createServiceLog() {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        return view('admin.createservicelog', compact('customers','services'));
    }
    public function storeServiceLog(Request $request) {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);
        ServiceLog::create($request->only([
            'customer_id','vehicle_id','service_id','price','discount','payment_method','notes'
        ]));
        return redirect()->route('admin.servicelog.create')->with('success', 'Service log added!');
    }
    public function ajaxCustomerVehicles(Request $request, $customer_id) {
        // Return all vehicles for the customer; do not filter by 'active'
        $query = CustomerVehicle::where('customer_id', $customer_id);

        $term = $request->input('q', $request->input('term', ''));
        if ($term) {
            $like = "%{$term}%";
            $query->where(function($q) use ($like) {
                $q->where('registration_number', 'like', $like)
                  ->orWhere('brand', 'like', $like)
                  ->orWhere('model', 'like', $like)
                  ->orWhere('vin', 'like', $like)
                  ->orWhere('year', 'like', $like);
            });
        }

        $vehicles = $query->orderByDesc('created_at')
            ->limit(20)
            ->get(['id','brand','model','year','registration_number','vin','colour']);

        $results = $vehicles->map(function($v) {
            $label = trim(($v->registration_number ? ($v->registration_number.' - ') : '') . ($v->brand.' '.$v->model.' '.$v->year));
            return [
                'id' => $v->id,
                'text' => $label,
                'registration_number' => $v->registration_number,
                'brand' => $v->brand,
                'model' => $v->model,
                'year' => $v->year,
                'vin' => $v->vin,
                'colour' => $v->colour,
            ];
        })->values();

        // Fallback: if no customer_vehicles found, also include fleet vehicles linked by customer_id
        if ($results->count() === 0) {
            $fleetQuery = \App\Models\Vehicle::query()
                ->where('customer_id', $customer_id);
            if ($term) {
                $like = "%{$term}%";
                $fleetQuery->where(function($q) use ($like) {
                    $q->where('registration_number', 'like', $like)
                      ->orWhere('brand', 'like', $like)
                      ->orWhere('model', 'like', $like)
                      ->orWhere('vin', 'like', $like)
                      ->orWhere('year', 'like', $like);
                });
            }
            $fleet = $fleetQuery->orderByDesc('created_at')
                ->limit(20)
                ->get(['id','brand','model','year','registration_number','vin','colour']);
            $fleetResults = $fleet->map(function($v) {
                $label = trim(($v->registration_number ? ($v->registration_number.' - ') : '') . ($v->brand.' '.$v->model.' '.$v->year) . ' (Fleet)');
                return [
                    'id' => 'fleet-'.$v->id, // prefix to avoid collision with customer_vehicles ids
                    'text' => $label,
                    'registration_number' => $v->registration_number,
                    'brand' => $v->brand,
                    'model' => $v->model,
                    'year' => $v->year,
                    'vin' => $v->vin,
                    'colour' => $v->colour,
                    'source' => 'fleet'
                ];
            })->values();
            if ($fleetResults->count() > 0) {
                // Return these; still allow add-new option for clarity
                $results = $fleetResults;
            }
        }

        return response()->json([
            'results' => $results,
            'can_create' => ($results->count() === 0),
            'query' => $term,
        ]);
    }

    /**
     * AJAX: Quick-create a vehicle for a customer
     */
    public function quickCreateVehicle(Request $request, $customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'registration_number' => 'nullable|string|max:255',
            'vin' => 'nullable|string|max:255',
            'colour' => 'nullable|string|max:255',
        ]);

        $vehicle = new CustomerVehicle($validated);
        $vehicle->customer_id = $customer->id;
        $vehicle->vin = $vehicle->vin ?: ('VIN-' . uniqid());
        $vehicle->active = true;
        $vehicle->save();

        return response()->json([
            'success' => true,
            'vehicle' => [
                'id' => $vehicle->id,
                'registration_number' => $vehicle->registration_number,
                'brand' => $vehicle->brand,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'vin' => $vehicle->vin,
                'colour' => $vehicle->colour,
                'text' => trim(($vehicle->registration_number ? ($vehicle->registration_number.' - ') : '') . ($vehicle->brand.' '.$vehicle->model.' '.$vehicle->year)),
            ],
        ]);
    }

    public function vehicleLookup(Request $request)
    {
        // Get all customer vehicles with their customers
        $query = CustomerVehicle::with('customer')
            ->where('active', true);
        
        // Apply search filter
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('brand', 'like', "%{$searchTerm}%")
                  ->orWhere('model', 'like', "%{$searchTerm}%")
                  ->orWhere('registration_no', 'like', "%{$searchTerm}%")
                  ->orWhere('vin', 'like', "%{$searchTerm}%")
                  ->orWhereHas('customer', function($customerQuery) use ($searchTerm) {
                      $customerQuery->where('name', 'like', "%{$searchTerm}%")
                                  ->orWhere('phone', 'like', "%{$searchTerm}%");
                  });
            });
        }
        
        // Apply brand filter
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }
        
        $vehicles = $query->orderBy('created_at', 'desc')->get();
        
        return view('admin.vehiclelookup', compact('vehicles'));
    }

    public function deleteVehicle($vehicle_id)
    {
        $vehicle = CustomerVehicle::findOrFail($vehicle_id);
        $customer_id = $vehicle->customer_id;
        
        // Soft delete by setting active to false
        $vehicle->update(['active' => false]);
        
        return redirect()->route('admin.vehicle.lookup')->with('success', 'Vehicle deleted successfully!');
    }

    // Invoice Management Methods
    public function invoiceList(Request $request)
    {
        $query = Invoice::with(['customer', 'customerVehicle']);
        
        // Filter by payment status
        if ($request->has('status') && $request->status !== '') {
            $query->where('payment_status', $request->status);
        }
        
        // Search by customer name or invoice number
        if ($request->has('search') && trim($request->search) !== '') {
            $search = trim($request->search);
            $query->where(function($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($customerQuery) use ($search) {
                      $customerQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        $invoices = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.invoices.list', compact('invoices'));
    }

    public function createInvoice(Request $request)
    {
        $customers = Customer::orderBy('name')->get();
        $selectedCustomer = null;
        $customerVehicles = collect();
        
        if ($request->has('customer_id') && $request->customer_id) {
            $selectedCustomer = Customer::find($request->customer_id);
            $customerVehicles = CustomerVehicle::where('customer_id', $request->customer_id)->get();
        }
        
        return view('admin.invoices.create', compact('customers', 'selectedCustomer', 'customerVehicles'));
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_registration' => 'required|string',
            'vehicle_brand' => 'required|string',
            'vehicle_model' => 'required|string',
            'vehicle_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'vehicle_vin' => 'nullable|string',
            'vehicle_colour' => 'nullable|string',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Find or create vehicle
        $vehicle = CustomerVehicle::where('customer_id', $request->customer_id)
                                 ->where('registration_number', $request->vehicle_registration)
                                 ->first();
        
        if (!$vehicle) {
            $vehicle = CustomerVehicle::create([
                'customer_id' => $request->customer_id,
                'brand' => $request->vehicle_brand,
                'model' => $request->vehicle_model,
                'year' => $request->vehicle_year,
                'registration_number' => $request->vehicle_registration,
                'vin' => $request->vehicle_vin ?: 'VIN-' . uniqid(),
                'colour' => $request->vehicle_colour,
                'active' => true,
            ]);
        }

        // Create invoice
        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'customer_vehicle_id' => $vehicle->id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'tax_amount' => $request->tax_amount ?? 0,
            'discount_amount' => $request->discount_amount ?? 0,
            'notes' => $request->notes,
            'status' => 'draft',
            'user_id' => auth()->user() ? auth()->user()->id : null,
        ]);

        // Create invoice items
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Calculate totals
        $invoice->calculateTotals();

        return redirect()->route('admin.invoices.view', $invoice->id)->with('success', 'Invoice created successfully');
    }

    public function viewInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'customerVehicle', 'items'])->findOrFail($id);
        return view('admin.invoices.view', compact('invoice'));
    }

    public function showInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'customerVehicle', 'items'])->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function customerInvoices($customer_id)
    {
        $customer = Customer::findOrFail($customer_id);
        $invoices = Invoice::where('customer_id', $customer_id)
                          ->with(['customerVehicle', 'items'])
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);
        
        return view('admin.invoices.customer', compact('customer', 'invoices'));
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'customerVehicle', 'items'])->findOrFail($id);
        return view('admin.invoices.print', compact('invoice'));
    }

    public function recordPayment(Request $request, $id)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_notes' => 'nullable|string',
        ]);

        $invoice = Invoice::findOrFail($id);
        
        // Validate payment amount doesn't exceed balance due
        if ($request->payment_amount > $invoice->balance_due) {
            return back()->withErrors(['payment_amount' => 'Payment amount cannot exceed balance due.']);
        }

        // Update payment information
        $invoice->paid_amount += $request->payment_amount;
        $invoice->payment_method = $request->payment_method;
        $invoice->payment_notes = $request->payment_notes;
        
        // Recalculate totals and update payment status
        $invoice->calculateTotals();
        
        return redirect()->route('admin.invoices.view', $invoice->id)->with('success', 'Payment recorded successfully');
    }

    public function editInvoice($id)
    {
        $invoice = Invoice::with(['customer', 'customerVehicle', 'items'])->findOrFail($id);
        $customers = Customer::orderBy('name')->get();
        $customerVehicles = CustomerVehicle::where('customer_id', $invoice->customer_id)->get();
        
        return view('admin.invoices.edit', compact('invoice', 'customers', 'customerVehicles'));
    }

    public function updateInvoice(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'vehicle_registration' => 'required|string',
            'vehicle_brand' => 'required|string',
            'vehicle_model' => 'required|string',
            'vehicle_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'vehicle_vin' => 'nullable|string',
            'vehicle_colour' => 'nullable|string',
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date|after_or_equal:invoice_date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'tax_amount' => 'nullable|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Update or create vehicle if needed
        $vehicle = CustomerVehicle::where('customer_id', $request->customer_id)
                                 ->where('registration_number', $request->vehicle_registration)
                                 ->first();
        
        if (!$vehicle) {
            $vehicle = CustomerVehicle::create([
                'customer_id' => $request->customer_id,
                'brand' => $request->vehicle_brand,
                'model' => $request->vehicle_model,
                'year' => $request->vehicle_year,
                'registration_number' => $request->vehicle_registration,
                'vin' => $request->vehicle_vin ?: 'VIN-' . uniqid(),
                'colour' => $request->vehicle_colour,
                'active' => true,
            ]);
        }

        // Update invoice
        $invoice->update([
            'customer_id' => $request->customer_id,
            'customer_vehicle_id' => $vehicle->id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'tax_amount' => $request->tax_amount ?? 0,
            'discount_amount' => $request->discount_amount ?? 0,
            'notes' => $request->notes,
            'user_id' => auth()->id(),
        ]);

        // Delete existing items and create new ones
        $invoice->items()->delete();
        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Recalculate totals
        $invoice->calculateTotals();

        return redirect()->route('admin.invoices.view', $invoice->id)->with('success', 'Invoice updated successfully');
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        
        // Check if invoice has payments
        if ($invoice->paid_amount > 0) {
            return back()->withErrors(['error' => 'Cannot delete invoice with recorded payments.']);
        }
        
        $invoice->delete();
        
        return redirect()->route('admin.invoices.list')->with('success', 'Invoice deleted successfully');
    }

    // Settings Management
    public function settings()
    {
        $settings = Setting::getAllGrouped();
        
        // Initialize default settings if none exist
        if ($settings->isEmpty()) {
            $this->initializeDefaultSettings();
            $settings = Setting::getAllGrouped();
        }
        
        return view('admin.settings.index', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->settings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    // Handle file upload
                    $file = $request->file("settings.{$key}");
                    $uploadedFileUrl = Cloudinary::upload($file->getRealPath())->getSecurePath();
                    $value = $uploadedFileUrl;
                }
                
                Setting::set($key, $value);
            }
        }

        Setting::clearCache();
        
        return back()->with('success', 'Settings updated successfully');
    }

    private function initializeDefaultSettings()
    {
        $defaultSettings = [
            // Company Information
            ['key' => 'company_name', 'value' => 'Boomerang Rentals', 'type' => 'text', 'group' => 'company', 'label' => 'Company Name'],
            ['key' => 'company_address', 'value' => '123 Business Street, City, State 12345', 'type' => 'textarea', 'group' => 'company', 'label' => 'Company Address'],
            ['key' => 'company_phone', 'value' => '(555) 123-4567', 'type' => 'text', 'group' => 'company', 'label' => 'Phone Number'],
            ['key' => 'company_email', 'value' => 'info@boomerangrentals.com', 'type' => 'email', 'group' => 'company', 'label' => 'Email Address'],
            ['key' => 'company_abn', 'value' => '12 345 678 901', 'type' => 'text', 'group' => 'company', 'label' => 'ABN Number'],
            ['key' => 'company_logo', 'value' => '', 'type' => 'image', 'group' => 'company', 'label' => 'Company Logo'],
            
            // Invoice Settings
            ['key' => 'invoice_color', 'value' => '#007bff', 'type' => 'color', 'group' => 'invoice', 'label' => 'Invoice Color Theme'],
            ['key' => 'invoice_prefix', 'value' => 'INV', 'type' => 'text', 'group' => 'invoice', 'label' => 'Invoice Number Prefix'],
            ['key' => 'invoice_footer', 'value' => 'Thank you for your business!', 'type' => 'textarea', 'group' => 'invoice', 'label' => 'Invoice Footer Text'],
            ['key' => 'show_invoice_logo', 'value' => '1', 'type' => 'checkbox', 'group' => 'invoice', 'label' => 'Show Logo on Invoice'],
            
            // General Settings
            ['key' => 'default_currency', 'value' => 'AUD', 'type' => 'text', 'group' => 'general', 'label' => 'Default Currency'],
            ['key' => 'tax_rate', 'value' => '10', 'type' => 'number', 'group' => 'general', 'label' => 'Default Tax Rate (%)'],
        ];

        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }

    // Consolidated Invoice Management
    public function consolidatedInvoiceList()
    {
        $query = ConsolidatedInvoice::with(['customer', 'invoices.items']);
        
        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->whereHas('customer', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('consolidated_number', 'like', "%{$search}%");
        }
        
        // Filter by payment status
        if (request('status') && request('status') !== 'all') {
            $query->where('payment_status', request('status'));
        }
        
        $consolidatedInvoices = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.consolidated-invoices.list', compact('consolidatedInvoices'));
    }

    public function exportConsolidatedInvoiceExcel($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::with(['customer', 'invoices.items', 'invoices.customerVehicle'])->findOrFail($id);
        
        $filename = 'consolidated_invoice_' . $consolidatedInvoice->consolidated_number . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($consolidatedInvoice) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for proper UTF-8 encoding in Excel
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header Information
            fputcsv($file, ['Consolidated Invoice Export']);
            fputcsv($file, ['Generated on', date('Y-m-d H:i:s')]);
            fputcsv($file, []);
            
            // Consolidated Invoice Info
            fputcsv($file, ['Consolidated Invoice Details']);
            fputcsv($file, ['Consolidated Number', $consolidatedInvoice->consolidated_number]);
            fputcsv($file, ['Customer', $consolidatedInvoice->customer->name ?? 'N/A']);
            fputcsv($file, ['Customer Email', $consolidatedInvoice->customer->email ?? 'N/A']);
            fputcsv($file, ['Customer Phone', $consolidatedInvoice->customer->phone ?? 'N/A']);
            fputcsv($file, ['Consolidated Date', $consolidatedInvoice->consolidated_date ? $consolidatedInvoice->consolidated_date->format('Y-m-d') : 'N/A']);
            fputcsv($file, ['Due Date', $consolidatedInvoice->due_date ? $consolidatedInvoice->due_date->format('Y-m-d') : 'N/A']);
            fputcsv($file, ['Total Amount', '$' . number_format($consolidatedInvoice->total_amount ?? 0, 2)]);
            fputcsv($file, ['Amount Paid', '$' . number_format($consolidatedInvoice->paid_amount ?? 0, 2)]);
            fputcsv($file, ['Balance Due', '$' . number_format($consolidatedInvoice->balance_due ?? 0, 2)]);
            fputcsv($file, ['Payment Status', ucfirst($consolidatedInvoice->payment_status ?? 'pending')]);
            fputcsv($file, []);
            
            // Detailed Invoice Items
            fputcsv($file, ['Detailed Invoice Items']);
            fputcsv($file, ['Invoice Number', 'Invoice Date', 'Vehicle', 'Item Description', 'Item Notes', 'Quantity', 'Unit Price', 'Total Price', 'Invoice Status']);
            
            foreach ($consolidatedInvoice->invoices as $invoice) {
                $invoiceNumber = $invoice->invoice_number;
                $invoiceDate = $invoice->invoice_date ? $invoice->invoice_date->format('Y-m-d') : 'N/A';
                $vehicle = '';
                if ($invoice->customerVehicle) {
                    $vehicle = ($invoice->customerVehicle->year ?? '') . ' ' . 
                              ($invoice->customerVehicle->make ?? '') . ' ' . 
                              ($invoice->customerVehicle->model ?? '') . ' (' . 
                              ($invoice->customerVehicle->registration ?? 'No Registration') . ')';
                }
                $invoiceStatus = ucfirst($invoice->payment_status ?? 'unpaid');
                
                if ($invoice->items && $invoice->items->count() > 0) {
                    foreach ($invoice->items as $item) {
                        fputcsv($file, [
                            $invoiceNumber,
                            $invoiceDate,
                            $vehicle,
                            $item->description ?? 'N/A',
                            $item->notes ?? '',
                            $item->quantity ?? 0,
                            '$' . number_format($item->unit_price ?? 0, 2),
                            '$' . number_format($item->total_price ?? 0, 2),
                            $invoiceStatus
                        ]);
                    }
                } else {
                    fputcsv($file, [
                        $invoiceNumber,
                        $invoiceDate,
                        $vehicle,
                        'No items found',
                        '',
                        0,
                        '$0.00',
                        '$0.00',
                        $invoiceStatus
                    ]);
                }
            }
            
            fputcsv($file, []);
            fputcsv($file, ['Summary']);
            fputcsv($file, ['Total Invoices', $consolidatedInvoice->invoices->count()]);
            $totalItems = $consolidatedInvoice->invoices->sum(function($invoice) {
                return $invoice->items->sum('quantity');
            });
            fputcsv($file, ['Total Items', $totalItems]);
            fputcsv($file, ['Grand Total', '$' . number_format($consolidatedInvoice->total_amount ?? 0, 2)]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportInvoiceExcel($id)
    {
        $invoice = Invoice::with(['customer', 'customerVehicle', 'items'])->findOrFail($id);
        
        $filename = 'invoice_' . $invoice->invoice_number . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($invoice) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for proper UTF-8 encoding in Excel
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header Information
            fputcsv($file, ['Invoice Export']);
            fputcsv($file, ['Generated on', date('Y-m-d H:i:s')]);
            fputcsv($file, []);
            
            // Invoice Info
            fputcsv($file, ['Invoice Details']);
            fputcsv($file, ['Invoice Number', $invoice->invoice_number]);
            fputcsv($file, ['Customer', $invoice->customer->name ?? 'N/A']);
            fputcsv($file, ['Customer Email', $invoice->customer->email ?? 'N/A']);
            fputcsv($file, ['Customer Phone', $invoice->customer->phone ?? 'N/A']);
            fputcsv($file, ['Invoice Date', $invoice->invoice_date ? $invoice->invoice_date->format('Y-m-d') : 'N/A']);
            fputcsv($file, ['Due Date', $invoice->due_date ? $invoice->due_date->format('Y-m-d') : 'N/A']);
            
            if ($invoice->customerVehicle) {
                fputcsv($file, ['Vehicle', ($invoice->customerVehicle->year ?? '') . ' ' . 
                                         ($invoice->customerVehicle->make ?? '') . ' ' . 
                                         ($invoice->customerVehicle->model ?? '') . ' (' . 
                                         ($invoice->customerVehicle->registration ?? 'No Registration') . ')']);
            }
            
            fputcsv($file, ['Subtotal', '$' . number_format($invoice->subtotal ?? 0, 2)]);
            fputcsv($file, ['Tax Amount', '$' . number_format($invoice->tax_amount ?? 0, 2)]);
            fputcsv($file, ['Discount Amount', '$' . number_format($invoice->discount_amount ?? 0, 2)]);
            fputcsv($file, ['Total Amount', '$' . number_format($invoice->total_amount ?? 0, 2)]);
            fputcsv($file, ['Payment Status', ucfirst($invoice->payment_status ?? 'unpaid')]);
            fputcsv($file, []);
            
            // Invoice Items
            fputcsv($file, ['Invoice Items']);
            fputcsv($file, ['Description', 'Notes', 'Quantity', 'Unit Price', 'Total Price']);
            
            if ($invoice->items && $invoice->items->count() > 0) {
                foreach ($invoice->items as $item) {
                    fputcsv($file, [
                        $item->description ?? 'N/A',
                        $item->notes ?? '',
                        $item->quantity ?? 0,
                        '$' . number_format($item->unit_price ?? 0, 2),
                        '$' . number_format($item->total_price ?? 0, 2)
                    ]);
                }
            } else {
                fputcsv($file, ['No items found', '', 0, '$0.00', '$0.00']);
            }
            
            fputcsv($file, []);
            fputcsv($file, ['Summary']);
            fputcsv($file, ['Total Items', $invoice->items->count()]);
            fputcsv($file, ['Total Quantity', $invoice->items->sum('quantity')]);
            fputcsv($file, ['Invoice Total', '$' . number_format($invoice->total_amount ?? 0, 2)]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function createConsolidatedInvoice(Request $request)
    {
        $customerId = $request->customer_id;
        $customer = null;
        $unpaidInvoices = collect();
        
        if ($customerId) {
            $customer = Customer::findOrFail($customerId);
            $unpaidInvoices = Invoice::where('customer_id', $customerId)
                                   ->whereIn('payment_status', ['unpaid', 'partial'])
                                   ->whereDoesntHave('consolidatedInvoices')
                                   ->orderBy('invoice_date', 'asc')
                                   ->get();
        }
        
        $customers = Customer::orderBy('name')->get();
        
        return view('admin.consolidated-invoices.create', compact('customers', 'customer', 'unpaidInvoices'));
    }

    public function storeConsolidatedInvoice(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'selected_invoices' => 'required|array|min:1',
            'selected_invoices.*' => 'exists:invoices,id',
            'due_date' => 'nullable|date|after:today',
            'notes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Create consolidated invoice
            $consolidatedInvoice = ConsolidatedInvoice::create([
                'consolidated_number' => ConsolidatedInvoice::generateConsolidatedNumber(),
                'customer_id' => $request->customer_id,
                'consolidated_date' => now(),
                'due_date' => $request->due_date,
                'total_amount' => 0,
                'paid_amount' => 0,
                'balance_due' => 0,
                'payment_status' => 'unpaid',
                'notes' => $request->notes
            ]);

            // Attach selected invoices
            $totalAmount = 0;
            foreach ($request->selected_invoices as $invoiceId) {
                $invoice = Invoice::findOrFail($invoiceId);
                $amount = $invoice->balance_due > 0 ? $invoice->balance_due : $invoice->total_amount;
                
                $consolidatedInvoice->invoices()->attach($invoiceId, [
                    'amount' => $amount
                ]);
                
                $totalAmount += $amount;
            }

            // Update consolidated invoice totals
            $consolidatedInvoice->update([
                'total_amount' => $totalAmount,
                'balance_due' => $totalAmount
            ]);

            DB::commit();

            return redirect()->route('admin.consolidated-invoices.view', $consolidatedInvoice->id)
                           ->with('success', 'Consolidated invoice created successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to create consolidated invoice: ' . $e->getMessage()]);
        }
    }

    public function viewConsolidatedInvoice($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::with(['customer', 'invoices'])->findOrFail($id);
        
        return view('admin.consolidated-invoices.view', compact('consolidatedInvoice'));
    }

    public function recordConsolidatedPayment(Request $request, $id)
    {
        $request->validate([
            'payment_amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,bank_transfer,card,online,abn,other',
            'payment_notes' => 'nullable|string'
        ]);

        $consolidatedInvoice = ConsolidatedInvoice::with('invoices')->findOrFail($id);
        
        // Validate payment amount
        if ($request->payment_amount > $consolidatedInvoice->balance_due) {
            return back()->withErrors(['payment_amount' => 'Payment amount cannot exceed balance due']);
        }

        try {
            DB::beginTransaction();

            // Update consolidated invoice
            $consolidatedInvoice->paid_amount += $request->payment_amount;
            $consolidatedInvoice->balance_due = $consolidatedInvoice->total_amount - $consolidatedInvoice->paid_amount;
            $consolidatedInvoice->payment_method = $request->payment_method;
            $consolidatedInvoice->payment_notes = $request->payment_notes;

            if ($consolidatedInvoice->balance_due <= 0) {
                $consolidatedInvoice->payment_status = 'paid';
                $consolidatedInvoice->paid_at = now();
                $consolidatedInvoice->balance_due = 0;
                
                // Mark all individual invoices as paid
                $consolidatedInvoice->markInvoicesAsPaid();
            } else {
                $consolidatedInvoice->payment_status = 'partial';
                
                // Update individual invoices proportionally for partial payments
                $consolidatedInvoice->updateInvoicesForPartialPayment($request->payment_amount);
            }

            $consolidatedInvoice->save();

            DB::commit();

            return back()->with('success', 'Payment recorded successfully');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to record payment: ' . $e->getMessage()]);
        }
    }

    public function printConsolidatedInvoice($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::with(['customer', 'invoices.items'])->findOrFail($id);
        
        return view('admin.consolidated-invoices.print', compact('consolidatedInvoice'));
    }

    public function customerConsolidatedInvoices($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $consolidatedInvoices = ConsolidatedInvoice::where('customer_id', $customerId)
                                                  ->orderBy('created_at', 'desc')
                                                  ->paginate(10);

        return view('admin.consolidated-invoices.customer', compact('customer', 'consolidatedInvoices'));
    }

    public function showConsolidatedInvoice($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::with(['customer', 'invoices.items'])->findOrFail($id);

        return view('admin.consolidated-invoices.show', compact('consolidatedInvoice'));
    }

    public function downloadConsolidatedInvoice($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::with(['customer', 'invoices.items'])->findOrFail($id);

        // For now, redirect to print view - can be enhanced later for PDF download
        return redirect()->route('admin.consolidated-invoices.print', $id);
    }

    public function deleteConsolidatedInvoice($id)
    {
        $consolidatedInvoice = ConsolidatedInvoice::findOrFail($id);
        
        // Remove the relationship with invoices first
        $consolidatedInvoice->invoices()->detach();
        
        // Delete the consolidated invoice
        $consolidatedInvoice->delete();

        return redirect()->route('admin.consolidated-invoices.list')
                        ->with('success', 'Consolidated invoice deleted successfully.');
    }

    // Team Management Methods
    public function teamList()
    {
        $teams = Team::orderBy('created_at', 'desc')->get();
        return view('admin.team.list', compact('teams'));
    }

    public function createTeam()
    {
        return view('admin.team.create');
    }

    public function storeTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'business_title' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'thoughts' => 'nullable|string',
            'vision_statement' => 'nullable|string',
            'company_message' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'snap' => 'nullable|url',
            'visibility' => 'boolean',
            'is_chairman' => 'boolean'
        ]);

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
            $data['photo'] = $uploadedFileUrl;
        }

        $data['visibility'] = $request->has('visibility');
        $data['is_chairman'] = $request->has('is_chairman');

        Team::create($data);

        return redirect()->route('admin.team.list')->with('success', 'Team member added successfully.');
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'));
    }

    public function updateTeam(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'business_title' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'thoughts' => 'nullable|string',
            'vision_statement' => 'nullable|string',
            'company_message' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'snap' => 'nullable|url',
            'visibility' => 'boolean',
            'is_chairman' => 'boolean'
        ]);

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
            $data['photo'] = $uploadedFileUrl;
        }

        $data['visibility'] = $request->has('visibility');
        $data['is_chairman'] = $request->has('is_chairman');

        $team->update($data);

        return redirect()->route('admin.team.list')->with('success', 'Team member updated successfully.');
    }

    public function deleteTeam($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect()->route('admin.team.list')->with('success', 'Team member deleted successfully.');
    }

    public function toggleTeamVisibility($id)
    {
        $team = Team::findOrFail($id);
        $team->visibility = !$team->visibility;
        $team->save();

        return response()->json(['success' => true, 'visibility' => $team->visibility]);
    }

    // Owner Info Edit/Update
    public function editOwner()
    {
        $owner = \App\Models\BusinessOwner::first();
        return view('admin.owner.edit', ['owner' => $owner]);
    }

    public function updateOwner(Request $request)
    {
        $owner = \App\Models\BusinessOwner::first();
        if (!$owner) {
            $owner = new \App\Models\BusinessOwner();
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'business_title' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'thoughts' => 'nullable|string',
            'vision_statement' => 'nullable|string',
            'company_message' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
            'snap' => 'nullable|url',
            // No validation for visibility, handle as checkbox
        ]);

        $owner->name = $request->name;
        $owner->position = $request->position;
        $owner->business_title = $request->business_title;
        $owner->thoughts = $request->thoughts;
        $owner->vision_statement = $request->vision_statement;
        $owner->company_message = $request->company_message;
        $owner->email = $request->email;
        $owner->phone = $request->phone;
        $owner->instagram = $request->instagram;
        $owner->facebook = $request->facebook;
        $owner->snap = $request->snap;
        $owner->visibility = $request->has('visibility');
        if ($request->hasFile('photo')) {
            $uploadResult = Cloudinary::uploadApi()->upload($request->file('photo')->getRealPath());
            $owner->photo = $uploadResult['secure_url'] ?? null;
        }
        $owner->save();
        return redirect()->route('admin.owner.edit')->with('success', 'Business owner info updated successfully.');
    }
}