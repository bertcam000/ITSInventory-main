<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">
    <div class="mx-auto max-w-7xl p-6">
        <div class="no-print mb-6 flex items-center justify-between">
            <a href="{{ route('stocks.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                ← Back
            </a>

            <button onclick="window.print()" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                Print Report
            </button>
        </div>

        <div class="rounded-2xl bg-white p-8 shadow-sm">
            <div class="border-b border-slate-200 pb-6 text-center">
                <h1 class="text-2xl font-bold text-slate-900">IT Low Stock Report</h1>
                <p class="mt-2 text-sm text-slate-500">Items that need replenishment</p>
                <p class="mt-1 text-sm text-slate-500">Generated on {{ now()->format('M d, Y h:i A') }}</p>
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full border border-slate-300 text-sm">
                    <thead class="bg-slate-100">
                        <tr>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Item Code</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Item Name</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Category</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Brand / Model</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Current Qty</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Min Stock</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Location</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr>
                                <td class="border border-slate-300 px-4 py-3">{{ $stock->item_code }}</td>
                                <td class="border border-slate-300 px-4 py-3">{{ $stock->item_name }}</td>
                                <td class="border border-slate-300 px-4 py-3">{{ $stock->category }}</td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $stock->brand ?: 'N/A' }}
                                    @if($stock->model)
                                        / {{ $stock->model }}
                                    @endif
                                </td>
                                <td class="border border-slate-300 px-4 py-3 font-semibold">
                                    {{ $stock->quantity }} {{ $stock->unit }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $stock->minimum_stock }} {{ $stock->unit }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">{{ $stock->location }}</td>
                                <td class="border border-slate-300 px-4 py-3">
                                    @if($stock->status === 'out_of_stock')
                                        <span class="font-semibold text-rose-700">Out of Stock</span>
                                    @else
                                        <span class="font-semibold text-amber-700">Low Stock</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="border border-slate-300 px-4 py-6 text-center text-slate-500">
                                    No low stock or out of stock items found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-10 flex justify-between text-sm">
                <div>
                    <p class="font-semibold text-slate-700">Prepared by:</p>
                    <div class="mt-10 border-t border-slate-400 pt-2">
                        <p>{{ auth()->user()->name ?? 'System User' }}</p>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-slate-700">Noted by:</p>
                    <div class="mt-10 border-t border-slate-400 pt-2">
                        <p>________________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>