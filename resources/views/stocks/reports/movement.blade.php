<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Movement Report</title>
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
        <!-- Top Actions -->
        <div class="no-print mb-6 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('stocks.index') }}" class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    ← Back
                </a>

                <button onclick="window.print()" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">
                    Print Report
                </button>
            </div>

            <form action="{{ route('stocks.reports.movement') }}" method="GET" class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">From</label>
                    <input
                        type="date"
                        name="date_from"
                        value="{{ request('date_from') }}"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm"
                    >
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">To</label>
                    <input
                        type="date"
                        name="date_to"
                        value="{{ request('date_to') }}"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm"
                    >
                </div>

                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700">Type</label>
                    <select
                        name="type"
                        class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm"
                    >
                        <option value="">All Types</option>
                        <option value="initial" {{ request('type') == 'initial' ? 'selected' : '' }}>Initial</option>
                        <option value="stock_in" {{ request('type') == 'stock_in' ? 'selected' : '' }}>Stock In</option>
                        <option value="stock_out" {{ request('type') == 'stock_out' ? 'selected' : '' }}>Stock Out</option>
                        <option value="adjustment" {{ request('type') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
                        <option value="details_updated" {{ request('type') == 'details_updated' ? 'selected' : '' }}>Details Updated</option>
                    </select>
                </div>

                <div class="sm:col-span-3 flex gap-2">
                    <button
                        type="submit"
                        class="rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700"
                    >
                        Apply Filter
                    </button>

                    <a
                        href="{{ route('stocks.reports.movement') }}"
                        class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                    >
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Printable Report -->
        <div class="rounded-2xl bg-white p-8 shadow-sm">
            <div class="border-b border-slate-200 pb-6 text-center">
                <h1 class="text-2xl font-bold text-slate-900">IT Stock Movement Report</h1>
                <p class="mt-2 text-sm text-slate-500">Stock movement and quantity transaction log</p>
                <p class="mt-1 text-sm text-slate-500">Generated on {{ now()->format('M d, Y h:i A') }}</p>

                @if(request('date_from') || request('date_to') || request('type'))
                    <div class="mt-4 text-xs text-slate-500">
                        @if(request('date_from'))
                            <span>From: {{ request('date_from') }}</span>
                        @endif

                        @if(request('date_to'))
                            <span class="ml-3">To: {{ request('date_to') }}</span>
                        @endif

                        @if(request('type'))
                            <span class="ml-3">Type: {{ str_replace('_', ' ', request('type')) }}</span>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full border border-slate-300 text-sm">
                    <thead class="bg-slate-100">
                        <tr>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Date</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Item Code</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Item Name</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Type</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Changed Qty</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Previous Qty</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">New Qty</th>
                            <th class="border border-slate-300 px-4 py-3 text-left font-semibold">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $history)
                            <tr>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->created_at->format('M d, Y h:i A') }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->stock->item_code ?? 'N/A' }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->stock->item_name ?? 'N/A' }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ str_replace('_', ' ', ucfirst($history->type)) }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3 font-semibold">
                                    {{ $history->quantity }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->previous_quantity }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->new_quantity }}
                                </td>
                                <td class="border border-slate-300 px-4 py-3">
                                    {{ $history->remarks ?: '—' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="border border-slate-300 px-4 py-6 text-center text-slate-500">
                                    No stock movement records found.
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