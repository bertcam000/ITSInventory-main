<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Campus;
use App\Models\Department;
use App\Models\PcAssignment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $totalAssets = Asset::count();
        $activeDevices = Asset::where('status', 'assigned')->count();
        $underMaintenance = Asset::where('status', 'maintenance')->count();
        $openTickets = 0;

        $assetsByCampus = PcAssignment::select(
                'campuses.name as campus_name',
                DB::raw('COUNT(pc_assignments.id) * 2 as total')
            )
            ->join('departments', 'pc_assignments.department_id', '=', 'departments.id')
            ->join('campuses', 'departments.campus_id', '=', 'campuses.id')
            ->groupBy('campuses.name')
            ->orderByDesc('total')
            ->get();

        $maxCampusTotal = $assetsByCampus->max('total');

        $assetsByDepartment = PcAssignment::select(
                'departments.name as department_name',
                DB::raw('COUNT(assets.id) as total')
            )
            ->join('departments', 'pc_assignments.department_id', '=', 'departments.id')
            ->join('assets', 'pc_assignments.system_unit_id', '=', 'assets.id')
            ->groupBy('departments.name')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) use ($totalAssets) {
                return [
                    'name' => $row->department_name,
                    'total' => $row->total,
                    'percentage' => $totalAssets > 0
                        ? round(($row->total / $totalAssets) * 100)
                        : 0,
                ];
            });


        $recentAssignments = PcAssignment::with([
                'systemUnit:id,brand,model,serial_number',
                'department:id,name,campus_id',
                'department.campus:id,name',
            ])
            ->latest()
            ->take(5)
            ->get();


        return view('pages.dashboard.index', compact(
            'totalAssets',
            'activeDevices',
            'underMaintenance',
            'openTickets',
            'assetsByCampus',
            'assetsByDepartment',
            'recentAssignments',
            'maxCampusTotal'
        ));
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
