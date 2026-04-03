<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Stock::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('item_name', 'like', '%' . $search . '%')
                ->orWhere('item_code', 'like', '%' . $search . '%')
                ->orWhere('brand', 'like', '%' . $search . '%')
                ->orWhere('model', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $stocks = $query->latest()->paginate(10)->withQueryString();

        $categories = Stock::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('stocks.index', compact('stocks', 'categories'));
    }

    public function history(Stock $stock)
    {
        $stock->load(['histories']);

        return view('stocks.history', compact('stock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function inventoryReport()
    {
        $stocks = Stock::orderBy('category')->orderBy('item_name')->get();

        return view('stocks.reports.inventory', compact('stocks'));
    }

    public function lowStockReport()
    {
        $stocks = Stock::whereIn('status', ['low_stock', 'out_of_stock'])
            ->orderBy('status')
            ->orderBy('category')
            ->orderBy('item_name')
            ->get();

        return view('stocks.reports.low-stock', compact('stocks'));
    }

    public function movementReport(Request $request)
    {
        $query = StockHistory::with('stock')->latest();

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $histories = $query->get();

        return view('stocks.reports.movement', compact('histories'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:255|unique:stocks,item_code',
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specification' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'location' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $stock = new Stock();
            $stock->fill($validated);
            $stock->created_by = auth()->id();
            $stock->updated_by = auth()->id();
            $stock->updateStockStatus();
            $stock->save();

            StockHistory::create([
                'stock_id' => $stock->id,
                'type' => 'initial',
                'quantity' => $stock->quantity,
                'previous_quantity' => 0,
                'new_quantity' => $stock->quantity,
                'remarks' => 'Initial stock entry',
                'updated_by' => auth()->id(),
            ]);
        });

        return redirect()->back()->with('success', 'Stock item created successfully.');
    }


    public function stockIn(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:1000',
        ]);

        DB::transaction(function () use ($validated, $stock) {
            $previousQuantity = $stock->quantity;
            $newQuantity = $previousQuantity + $validated['quantity'];

            $stock->quantity = $newQuantity;
            $stock->updated_by = auth()->id();
            $stock->updateStockStatus();
            $stock->save();

            StockHistory::create([
                'stock_id' => $stock->id,
                'type' => 'stock_in',
                'quantity' => $validated['quantity'],
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $newQuantity,
                'remarks' => $validated['remarks'] ?? 'Stock added',
                'updated_by' => auth()->id(),
            ]);
        });

        return redirect()->back()->with('success', 'Stock added successfully.');
    }


    public function stockOut(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string|max:1000',
        ]);

        if ($stock->quantity < $validated['quantity']) {
            return redirect()->back()->with('error', 'Insufficient stock quantity.');
        }

        DB::transaction(function () use ($validated, $stock) {
            $previousQuantity = $stock->quantity;
            $newQuantity = $previousQuantity - $validated['quantity'];

            $stock->quantity = $newQuantity;
            $stock->updated_by = auth()->id();
            $stock->updateStockStatus();
            $stock->save();

            StockHistory::create([
                'stock_id' => $stock->id,
                'type' => 'stock_out',
                'quantity' => $validated['quantity'],
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $newQuantity,
                'remarks' => $validated['remarks'] ?? 'Stock issued',
                'updated_by' => auth()->id(),
            ]);
        });

        return redirect()->back()->with('success', 'Stock issued successfully.');
    }

    
    public function adjustStock(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'new_quantity' => 'required|integer|min:0',
            'remarks' => 'required|string|max:1000',
        ]);

        DB::transaction(function () use ($validated, $stock) {
            $previousQuantity = $stock->quantity;
            $newQuantity = $validated['new_quantity'];
            $adjustedQuantity = abs($newQuantity - $previousQuantity);

            $stock->quantity = $newQuantity;
            $stock->updated_by = auth()->id();
            $stock->updateStockStatus();
            $stock->save();

            StockHistory::create([
                'stock_id' => $stock->id,
                'type' => 'adjustment',
                'quantity' => $adjustedQuantity,
                'previous_quantity' => $previousQuantity,
                'new_quantity' => $newQuantity,
                'remarks' => $validated['remarks'],
                'updated_by' => auth()->id(),
            ]);
        });

        return redirect()->back()->with('success', 'Stock adjusted successfully.');
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
    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:255|unique:stocks,item_code,' . $stock->id,
            'category' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'specification' => 'nullable|string|max:1000',
            'minimum_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'location' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $stock) {
            $stock->fill($validated);
            $stock->updated_by = auth()->id();
            $stock->updateStockStatus();
            $stock->save();

            StockHistory::create([
                'stock_id' => $stock->id,
                'type' => 'details_updated',
                'quantity' => 0,
                'previous_quantity' => $stock->quantity,
                'new_quantity' => $stock->quantity,
                'remarks' => 'Stock details updated',
                'updated_by' => auth()->id(),
            ]);
        });

        return redirect()
            ->route('stocks.index')
            ->with('success', 'Stock item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
