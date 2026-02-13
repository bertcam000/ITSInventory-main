<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Campus;
use App\Models\PcAssignment;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Department::query()
            ->with(['PcAssignments', 'campus']);

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

        $departments = $query->paginate(10)->withQueryString();

        // For dropdown + counts
        $campuses = Campus::withCount('department')->get();
        $totalDepartments = Department::count();

        return view(
            'pages.departments.index',
            compact('departments', 'campuses', 'totalDepartments')
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
   public function show($departmentId)
    {
        $department = Department::with([
            'pcAssignments.systemUnit',
            'pcAssignments.monitor',
            'campus'
        ])->findOrFail($departmentId);

        return view('pages.departments.result', compact('department'));
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
