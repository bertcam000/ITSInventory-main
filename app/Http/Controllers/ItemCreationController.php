<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemUnit;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ItemCreationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->validate([
            'serial_number' => ['required', 'unique:system_units,serial_number'],
            'brand' => ['required'],
            'specs' => ['required'],
            'status' => ['required']
        ]);

        $qrCode = QrCode::size(300)->generate($request->serial_number);
        SystemUnit::create([
            'serial_number' => $request->serial_number,
            'brand' => $request->brand,
            'specs' => $request->specs,
            'status' => $request->status
        ]);

        return view('qrcode', compact('qrCode'))->with('msg', 'Item Created Successfully');
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
