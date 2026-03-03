<?php

namespace App\Http\Controllers;

use App\Models\PcAssignment;
use App\Models\Department;
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
            $search = $request->name;

            $query->where(function ($q) use ($search) {
                $q->where('asset_id', 'like', "%{$search}%")
                ->orWhere('assigned_to', 'like', "%{$search}%");
            });
        }

        $PcAssigned = $query->paginate(10)->withQueryString();

        return view('pages.assigned_pc.index', compact('PcAssigned'));
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
