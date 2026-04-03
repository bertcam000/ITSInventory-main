<x-layouts.its_layout>

    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-7xl">
            <!-- Header -->
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <div class="flex items-center gap-3">
                        <a
                            href="{{ route('stocks.index') }}"
                            class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-100"
                        >
                            ← Back
                        </a>
                    </div>

                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">
                        {{ $stock->item_name }} History
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        View stock movement records, quantity changes, and adjustments.
                    </p>
                </div>
            </div>

            <!-- Item Summary -->
            <div class="mb-8 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Item Code</p>
                    <h2 class="mt-2 text-lg font-bold text-slate-900">{{ $stock->item_code }}</h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Current Quantity</p>
                    <h2 class="mt-2 text-lg font-bold text-slate-900">{{ $stock->quantity }} {{ $stock->unit }}</h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Category</p>
                    <h2 class="mt-2 text-lg font-bold text-slate-900">{{ $stock->category }}</h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Status</p>
                    @php
                        $statusClasses = match($stock->status) {
                            'in_stock' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                            'low_stock' => 'bg-amber-50 text-amber-700 ring-amber-200',
                            'out_of_stock' => 'bg-rose-50 text-rose-700 ring-rose-200',
                            'details_updated' => 'bg-violet-50 text-violet-700 ring-violet-200',
                            default => 'bg-slate-100 text-slate-700 ring-slate-200',
                        };

                        $dotClasses = match($stock->status) {
                            'in_stock' => 'bg-emerald-500',
                            'low_stock' => 'bg-amber-500',
                            'out_of_stock' => 'bg-rose-500',
                            default => 'bg-slate-400',
                        };
                    @endphp

                    <div class="mt-2">
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $statusClasses }}">
                            <span class="h-2 w-2 rounded-full {{ $dotClasses }}"></span>
                            {{ str_replace('_', ' ', ucfirst($stock->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Item Details -->
            <div class="mb-8 rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900">Item Details</h2>

                <div class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Brand</p>
                        <p class="mt-1 text-sm text-slate-700">{{ $stock->brand ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Model</p>
                        <p class="mt-1 text-sm text-slate-700">{{ $stock->model ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Location</p>
                        <p class="mt-1 text-sm text-slate-700">{{ $stock->location }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Minimum Stock</p>
                        <p class="mt-1 text-sm text-slate-700">{{ $stock->minimum_stock }} {{ $stock->unit }}</p>
                    </div>

                    <div class="md:col-span-2 xl:col-span-2">
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400">Specification</p>
                        <p class="mt-1 text-sm text-slate-700">{{ $stock->specification ?: 'No specification provided.' }}</p>
                    </div>
                </div>
            </div>

            <!-- History Table -->
            <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-lg font-semibold text-slate-900">Movement History</h2>
                    <p class="mt-1 text-sm text-slate-500">All recorded stock movements for this item.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Changed Qty</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Previous</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">New</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Remarks</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($stock->histories as $history)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        <div>
                                            <p class="font-medium text-slate-800">{{ $history->created_at->format('M d, Y') }}</p>
                                            <p class="text-xs text-slate-400">{{ $history->created_at->format('h:i A') }}</p>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 align-middle">
                                        @php
                                            $typeClasses = match($history->type) {
                                                'initial' => 'bg-blue-50 text-blue-700 ring-blue-200',
                                                'stock_in' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                                'stock_out' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                                'adjustment' => 'bg-slate-100 text-slate-700 ring-slate-200',
                                                default => 'bg-slate-100 text-slate-700 ring-slate-200',
                                            };
                                        @endphp

                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $typeClasses }}">
                                            {{ str_replace('_', ' ', ucfirst($history->type)) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm font-semibold text-slate-800">
                                        {{ $history->quantity }}
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $history->previous_quantity }}
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $history->new_quantity }}
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $history->remarks ?: '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500">
                                        No stock history found for this item.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.its_layout>