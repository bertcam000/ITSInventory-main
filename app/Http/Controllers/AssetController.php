<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Asset::query()->with(['systemUnitSpec', 'monitorSpec']);

        if ($request->filled('asset_type')) {
            $query->where('asset_type', $request->asset_type);
        }

        // if ($request->filled('brand')) {
        //     $query->where('brand', 'like', '%'.$request->brand.'%');
        // }

        if ($request->filled('status')) {
            $query->where('status', 'like', '%'.$request->status.'%');
        }


        if ($request->filled('serial_number')) {
            $query->where('serial_number', 'like', '%' . $request->serial_number . '%');
        }

        $assetTypeCounts = Asset::select('asset_type', DB::raw('count(*) as total'))
            ->groupBy('asset_type')
            ->pluck('total', 'asset_type');

        $statusCounts = Asset::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $statusCards = [
            'total'       => array_sum($assetTypeCounts->toArray()),
            'system_unit' => $assetTypeCounts['system_unit'] ?? 0,
            'laptop'      => $assetTypeCounts['laptop'] ?? 0,
            'monitor'     => $assetTypeCounts['monitor'] ?? 0,
            'printer'     => $assetTypeCounts['printer'] ?? 0,
            'assigned'    => $statusCounts['assigned'] ?? 0,
        ];


        $assets = $query->paginate(5)->withQueryString();


        return view('inventory.index', compact('assets', 'statusCards'));
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
