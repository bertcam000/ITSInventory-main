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
            'access_point'     => $assetTypeCounts['access_point'] ?? 0,
            'assigned'    => $statusCounts['assigned'] ?? 0,
        ];  


        $assets = $query->latest()->paginate(5)->withQueryString();


        return view('pages.inventory.index', compact('assets', 'statusCards'));
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
    public function show(Asset $asset)
    {
        $asset->load(['systemUnitSpec', 'monitorSpec']);

        $assignment = $asset->currentPcAssignment()
            ->with([
                'department.campus',
                'systemUnit.systemUnitSpec',
                'monitor.monitorSpec',
            ])
            ->first();

        return view('pages.inventory.result', compact('asset', 'assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset, Request $request)
    {
        $asset->load(['systemUnitSpec', 'monitorSpec']);

        return view('pages.inventory.edit', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Asset $asset)
    {
        $assetType = $asset->asset_type;

        $baseRules = [
            'serial_number' => 'nullable|string|max:255|unique:assets,serial_number,' . $asset->id,
            'brand'         => 'required|string|max:255',
            'model'         => 'required|string|max:255',
            'status'        => 'required|in:available,assigned,repair,retired',
            'remarks'       => 'nullable|string',
        ];

        $specRules = [];

        if (in_array($assetType, ['system_unit', 'laptop'])) {
            $specRules = [
                'processor' => 'nullable|string|max:255',
                'memory'    => 'nullable|string|max:255',
                'storage'   => 'nullable|string|max:255',
                'videocard' => 'nullable|string|max:255',
            ];
        } elseif ($assetType === 'monitor') {
            $specRules = [
                'size' => 'nullable|string|max:255',
            ];
        }

        $validated = $request->validate(array_merge($baseRules, $specRules));

        DB::transaction(function () use ($asset, $validated, $assetType) {

            $asset->update([
                'serial_number' => $validated['serial_number'] ?? null,
                'brand'         => $validated['brand'],
                'model'         => $validated['model'],
                'status'        => $validated['status'],
                'remarks'       => $validated['remarks'] ?? null,
            ]);

            if (in_array($assetType, ['system_unit', 'laptop'])) {
                $asset->systemUnitSpec()->updateOrCreate(
                    ['asset_id' => $asset->id],
                    [
                        'processor' => $validated['processor'] ?? null,
                        'memory'    => $validated['memory'] ?? null,
                        'storage'   => $validated['storage'] ?? null,
                        'videocard' => $validated['videocard'] ?? null,
                    ]
                );

                $asset->monitorSpec()->delete();
            }

            if ($assetType === 'monitor') {
                $asset->monitorSpec()->updateOrCreate(
                    ['asset_id' => $asset->id],
                    [
                        'size' => $validated['size'] ?? null,
                    ]
                );

                $asset->systemUnitSpec()->delete();
            }
        });

        return back()->with('success', 'Asset updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        if ($asset->asset_type === 'system_unit' && $asset->systemUnitSpec) {
            $asset->systemUnitSpec->delete();
        }

        if ($asset->asset_type === 'monitor' && $asset->monitorSpec) {
            $asset->monitorSpec->delete();
        }

        $asset->delete();

        return redirect('/inventory')
            ->with('success', 'Asset deleted successfully.');
    }
}
