<?php

namespace App\Http\Controllers;

use App\Models\PcAssignment;
use Illuminate\Http\Request;

class PcAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PcAssignment::query()->with(['systemUnit', 'monitor']);

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', 'like', '%' . $request->assigned_to . '%');
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
