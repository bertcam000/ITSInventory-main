<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Campus;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Location::query()
            ->with(['AccessPointAssignment', 'campus']);

       if ($request->filled('name')) {
            $search = strtolower($request->name);

            $query->whereRaw(
                'LOWER(name) LIKE ?',
                ["%{$search}%"]
            );
        }

        if ($request->filled('campus')) {
            $query->where('campus_id', $request->campus);
        }

        $locations = $query->paginate(10)->withQueryString();

        // For dropdown + counts
        $campuses = Campus::withCount('department')->get();
        $totalLocations = Location::count();

        return view(
            'pages.ap_location.index',
            compact('locations', 'campuses', 'totalLocations')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
