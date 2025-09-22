<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Review;
use App\Models\Team;
use App\Models\Vehicle;

use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        $vehicles = Vehicle::latest()->take(10)->get(); // limit to 6 or any number for homepage
        return view('welcome', compact('vehicles'));
    }
    public function service()
    {
        
        return view('service');
    }
    public function vehicles($category)
    {
        
        $vehicles = Vehicle::all();
        return view('vehicles', compact('vehicles'));
    }
    public function parts($category = null)
    {
        $query = Part::query();
        $categories = Part::select('type')->distinct()->pluck('type')->filter()->values();
        if ($category && $category !== 'all') {
            $query->where('type', $category);
        }
        $parts = $query->get();
        return view('parts', compact('parts', 'categories', 'category'));
    }
    public function contact()
    {
        
        return view('contact');
    }
    public function about()
    {
    $owner = \App\Models\BusinessOwner::where('visibility', true)->first();
    $teams = Team::where('visibility', true)->get();
    $reviews = Review::all();
    return view('about', compact('owner', 'teams', 'reviews'));
    }

    
}
