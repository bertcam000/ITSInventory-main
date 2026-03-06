<?php

namespace App\Http\Controllers;

use App\Models\PcAssignment;
use App\Models\Department;
use App\Models\Campus;
use Illuminate\Http\Request;

class PcAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PcAssignment::query()
            ->with(['systemUnit', 'monitor', 'department.campus']);

        if ($request->filled('name')) {
            $search = trim($request->name);

            $query->where(function ($q) use ($search) {
                $q->where('assigned_to', 'like', "%{$search}%")
                ->orWhereHas('systemUnit', function ($q2) use ($search) {
                    $q2->where('serial_number', 'like', "%{$search}%")
                        ->orWhere('asset_tag', 'like', "%{$search}%");
                })
                ->orWhereHas('monitor', function ($q2) use ($search) {
                    $q2->where('serial_number', 'like', "%{$search}%")
                        ->orWhere('asset_tag', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('campus')) {
            $campusId = $request->campus;

            $query->whereHas('department', function ($q) use ($campusId) {
                $q->where('campus_id', $campusId);
            });
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        $request->pages ? '' : 10;

        $PcAssigned = $query->paginate($pages = $request->pages ?: 10)->withQueryString();

        $campuses = Campus::orderBy('name')->get();

        $departments = Department::query()
            ->when($request->filled('campus'), fn($q) => $q->where('campus_id', $request->campus))
            ->orderBy('name')
            ->get();

        return view('pages.assigned_pc.index', compact('PcAssigned', 'campuses', 'departments'));
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
    public function show(Department $department)
    {
        $dept = PcAssignment::where('department_id', $department->id)->get();
        dd($dept);
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
