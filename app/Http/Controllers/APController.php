<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\AccessPointAssignment;

class APController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AccessPointAssignment::with([
            'asset',
            'department.campus'
        ]);

        // Filter by Campus
        if ($request->filled('campus')) {
            $query->whereHas('department.campus', function ($q) use ($request) {
                $q->where('id', $request->campus);
            });
        }

        // Filter by Department
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Search Asset Tag
        if ($request->filled('search')) {
            $query->whereHas('asset', function ($q) use ($request) {
                $q->where('asset_tag', 'like', '%' . $request->search . '%');
            });
        }

        $assignments = $query->latest()->paginate(10);

        $departments = Department::with('campus')->get();
        $campuses = Campus::all();

        return view('pages.assigned_ap.index', [
            'assignments' => $assignments,
            'departments' => $departments,
            'campuses' => $campuses
        ]);
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
