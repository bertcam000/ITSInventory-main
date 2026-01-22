<?php

namespace App\Http\Controllers;

use App\Models\SystemUnit;
use App\Models\Item;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate(Request $request)
    {
        $qrCode = QrCode::size(300)->generate($request->serial_number);
        Item::create([
            'serial_number' => $request->serial_number,
            'specs' => $request->specs,
            'location' => $request->location,
            'status' => $request->status,
            'category' => $request->category,
        ]);
        return view('qrcode', compact('qrCode'));
    }

    public function scan(Request $request)
    {
         $qr = $request->qr;

            echo response()->json([
            'status' => 'success',
            'qr' => $qr
        ]);
    }

    public function show(Request $request)
    {
        $qrCode = $request->query('qr');
        $item = SystemUnit::where('serial_number', $qrCode)->first();

        return view('show-qr', compact('item'));
    }
}
