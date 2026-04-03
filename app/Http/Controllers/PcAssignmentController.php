<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Campus;
use App\Models\Department;
use App\Models\PcAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PcAssignmentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    public function show(PcAssignment $pcAssignment)
    {
        $pcAssignment->load([
            'systemUnit.systemUnitSpec', 
            'monitor.monitorSpec', 
            'department.campus', 
            'histories.SystemUnit',
            'histories.monitor',
            'histories.user',]);
        
        return view('pages.assigned_pc.show', compact('pcAssignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PcAssignment $pcAssignment)
    {

        $pcAssignment->load(['systemUnit', 'monitor', 'department.campus']);

        $departments = Department::all();

        $systemUnits = Asset::where('asset_type', 'system_unit')
            ->where('status', 'available')
            ->latest()->get();

        $monitors = Asset::where('asset_type', 'monitor')
            ->where('status', 'available')
            ->latest()->get();


        return view('pages.assigned_pc.edit', [
            'assignment' => $pcAssignment,
            'departments' => $departments,
            'systemUnits' => $systemUnits,
            'monitors' => $monitors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PcAssignment $pcAssignment)
    {

        $request->validate([
            'asset_id' => 'required',
            'department_id' => 'required',
            'system_unit_id' => 'required',
            'monitor_id' => 'required',
            'assigned_to' => 'required'
        ]);

        DB::transaction(function () use ($request, $pcAssignment) {

            $oldSystemUnit = $pcAssignment->system_unit_id;
            $oldMonitor = $pcAssignment->monitor_id;

            $pcAssignment->update([
                'asset_id' => $request->asset_id,
                'department_id' => $request->department_id,
                'system_unit_id' => $request->system_unit_id,
                'monitor_id' => $request->monitor_id,
                'assigned_to' => $request->assigned_to,
            ]);

            if ($oldSystemUnit != $request->system_unit_id) {

                Asset::where('id', $oldSystemUnit)
                    ->update(['status' => 'available']);

                Asset::where('id', $request->system_unit_id)
                    ->update(['status' => 'assigned']);
            }

            if ($oldMonitor != $request->monitor_id) {

                Asset::where('id', $oldMonitor)
                    ->update(['status' => 'available']);

                Asset::where('id', $request->monitor_id)
                    ->update(['status' => 'assigned']);
            }

            PcAssignmentHistory::create([
                'pc_assignment_id' => $pcAssignment->id,
                'asset_tag' => $pcAssignment->asset_tag,
                'department_id' => $request->department_id,
                'system_unit_id' => $request->system_unit_id,
                'monitor_id' => $request->monitor_id,
                'assigned_to' => $request->assigned_to,
                'assigned_at' => now(),
                'updated_by' => auth()->id(),
                'action' => 'updated'
            ]);

        });

        return redirect('/assigned-pc')
            ->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PcAssignment $pcAssignment)
    {
        PcAssignmentHistory::create([
            'pc_assignment_id' => $pcAssignment->id,
            'asset_tag' => $pcAssignment->asset_tag,
            'department_id' => $pcAssignment->department_id,
            'system_unit_id' => $pcAssignment->system_unit_id,
            'monitor_id' => $pcAssignment->monitor_id,
            'assigned_to' => $pcAssignment->assigned_to,
            'assigned_at' => $pcAssignment->created_at,
            'unassigned_at' => now(),
            'updated_by' => auth()->id(),
            'action' => 'deleted'
        ]);

        $pcAssignment->systemUnit->update([
            'status' => 'available'
        ]);

        $pcAssignment->monitor->update([
            'status' => 'available'
        ]);

        Gate::authorize('delete', $pcAssignment);
        $pcAssignment->delete();

        return redirect('/assigned-pc')
            ->with('success', 'Asset deleted successfully.');
    }
}
