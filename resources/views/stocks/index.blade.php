<x-layouts.its_layout>
    <div 
        x-data="stockPage()" 
        class="min-h-screen bg-slate-50"
    >
        <div class="mx-auto max-w-7xl">
            <!-- Header -->
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">Stock Management</h1>
                    <p class="mt-1 text-sm text-slate-500">Manage stock room items, quantity movements, and adjustments.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a
                        href="{{ route('stocks.reports.inventory') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100"
                    >
                        Print Inventory Report
                    </a>

                    <a
                        href="{{ route('stocks.reports.low-stock') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-amber-200 bg-amber-50 px-5 py-3 text-sm font-semibold text-amber-700 shadow-sm transition hover:bg-amber-100"
                    >
                        Print Low Stock Report
                    </a>

                    <a
                        href="{{ route('stocks.reports.movement') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-blue-200 bg-blue-50 px-5 py-3 text-sm font-semibold text-blue-700 shadow-sm transition hover:bg-blue-100"
                    >
                        Print Movement Report
                    </a>

                    <button
                        @click="openCreateModal()"
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-700"
                    >
                        + New Stock Item
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-6 rounded-[28px] border border-slate-200 bg-white p-5 shadow-sm">
                <form action="{{ route('stocks.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-5">
                    <div class="xl:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-slate-700">Search</label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search item name, code, brand, or model"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        >
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
                        <select
                            name="category"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        >
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                        <select
                            name="status"
                            class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        >
                            <option value="">All Status</option>
                            <option value="in_stock" {{ request('status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                            <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                        >
                            Filter
                        </button>

                        <a
                            href="{{ route('stocks.index') }}"
                            class="w-full rounded-2xl border border-slate-200 px-5 py-3 text-center text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                        >
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Summary Cards -->
            <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total Items</p>
                    <h2 class="mt-2 text-3xl font-bold text-slate-900">{{ $stocks->count() }}</h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">In Stock</p>
                    <h2 class="mt-2 text-3xl font-bold text-emerald-600">
                        {{ $stocks->where('status', 'in_stock')->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Low Stock</p>
                    <h2 class="mt-2 text-3xl font-bold text-amber-600">
                        {{ $stocks->where('status', 'low_stock')->count() }}
                    </h2>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Out of Stock</p>
                    <h2 class="mt-2 text-3xl font-bold text-rose-600">
                        {{ $stocks->where('status', 'out_of_stock')->count() }}
                    </h2>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Item</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Code</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Category</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Quantity</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Location</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-[0.15em] text-slate-500">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($stocks as $stock)
                                <tr class="transition hover:bg-slate-50/80">
                                    <td class="px-6 py-4 align-middle">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $stock->item_name }}</p>
                                            <p class="mt-1 text-sm text-slate-500">
                                                {{ $stock->brand ?? 'No brand' }}
                                                @if($stock->model)
                                                    • {{ $stock->model }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $stock->item_code }}
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $stock->category }}
                                    </td>

                                    <td class="px-6 py-4 align-middle">
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $stock->quantity }} {{ $stock->unit }}</p>
                                            <p class="mt-1 text-xs text-slate-400">Min: {{ $stock->minimum_stock }}</p>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 align-middle text-sm text-slate-600">
                                        {{ $stock->location }}
                                    </td>

                                    <td class="px-6 py-4 align-middle">
                                        @php
                                            $statusClasses = match($stock->status) {
                                                'in_stock' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                                'low_stock' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                                'out_of_stock' => 'bg-rose-50 text-rose-700 ring-rose-200',
                                                default => 'bg-slate-100 text-slate-700 ring-slate-200',
                                            };

                                            $dotClasses = match($stock->status) {
                                                'in_stock' => 'bg-emerald-500',
                                                'low_stock' => 'bg-amber-500',
                                                'out_of_stock' => 'bg-rose-500',
                                                default => 'bg-slate-400',
                                            };
                                        @endphp

                                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold ring-1 {{ $statusClasses }}">
                                            <span class="h-2 w-2 rounded-full {{ $dotClasses }}"></span>
                                            {{ str_replace('_', ' ', ucfirst($stock->status)) }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 align-middle text-right">
    <div x-data="{ open: false }" class="relative inline-block text-left">
        <button
            @click="open = !open"
            class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100"
        >
            Actions
            <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div
            x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute right-0 z-20 mt-2 w-44 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl"
            style="display: none;"
        >
            <button
                @click='openStockInModal(@json($stock)); open = false'
                class="flex w-full items-center px-4 py-3 text-sm text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
            >
                Stock In
            </button>

            <button
                @click='openStockOutModal(@json($stock)); open = false'
                class="flex w-full items-center px-4 py-3 text-sm text-slate-700 transition hover:bg-amber-50 hover:text-amber-700"
            >
                Stock Out
            </button>

            <button
                @click='openAdjustModal(@json($stock)); open = false'
                class="flex w-full items-center px-4 py-3 text-sm text-slate-700 transition hover:bg-slate-100"
            >
                Adjust
            </button>

            <a
                href="{{ route('stocks.history', $stock->id) }}"
                class="flex w-full items-center px-4 py-3 text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-700"
            >
                History
            </a>

            <a
                href="{{ route('stocks.edit', $stock->id) }}"
                class="flex w-full items-center px-4 py-3 text-sm text-slate-700 transition hover:bg-violet-50 hover:text-violet-700"
            >
                Edit
            </a>
        </div>
    </div>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-500">
                                        No stock items found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3 p-5">
                        {{ $stocks->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div
            x-show="showCreateModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 px-4 py-6"
            style="display: none;"
        >
            <div @click.away="showCreateModal = false" class="w-full max-w-2xl rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">New Stock Item</h2>
                        <p class="mt-1 text-sm text-slate-500">Create a new stock record for your stock room.</p>
                    </div>

                    <button @click="showCreateModal = false" class="text-slate-400 transition hover:text-slate-600">
                        ✕
                    </button>
                </div>

                <form action="{{ route('stocks.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Item Name</label>
                            <input type="text" name="item_name" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Item Code</label>
                            <input type="text" name="item_code" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
                            <input type="text" name="category" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Brand</label>
                            <input type="text" name="brand" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Model</label>
                            <input type="text" name="model" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Unit</label>
                            <input type="text" name="unit" value="pcs" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Initial Quantity</label>
                            <input type="number" name="quantity" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Minimum Stock</label>
                            <input type="number" name="minimum_stock" min="0" value="5" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Location</label>
                            <input type="text" name="location" value="Stock Room" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Specification</label>
                            <textarea name="specification" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="showCreateModal = false" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                            Save Item
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stock In Modal -->
        <div
            x-show="showStockInModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 px-4 py-6"
            style="display: none;"
        >
            <div @click.away="showStockInModal = false" class="w-full max-w-lg rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Stock In</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Add quantity to <span class="font-semibold text-slate-700" x-text="selectedStock.item_name"></span>
                    </p>
                </div>

                <form :action="stockInAction" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Current Quantity</label>
                        <input type="text" :value="selectedStock.quantity + ' ' + selectedStock.unit" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600" readonly>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Add Quantity</label>
                        <input type="number" name="quantity" min="1" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100" required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Remarks</label>
                        <textarea name="remarks" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100" placeholder="Optional remarks"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" @click="showStockInModal = false" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                            Confirm Stock In
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stock Out Modal -->
        <div
            x-show="showStockOutModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 px-4 py-6"
            style="display: none;"
        >
            <div @click.away="showStockOutModal = false" class="w-full max-w-lg rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Stock Out</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Remove quantity from <span class="font-semibold text-slate-700" x-text="selectedStock.item_name"></span>
                    </p>
                </div>

                <form :action="stockOutAction" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Current Quantity</label>
                        <input type="text" :value="selectedStock.quantity + ' ' + selectedStock.unit" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600" readonly>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Remove Quantity</label>
                        <input type="number" name="quantity" min="1" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100" required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Remarks</label>
                        <textarea name="remarks" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-100" placeholder="Reason for stock out"></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" @click="showStockOutModal = false" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-2xl bg-amber-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-amber-600">
                            Confirm Stock Out
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Adjust Modal -->
        <div
            x-show="showAdjustModal"
            x-transition.opacity
            class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 px-4 py-6"
            style="display: none;"
        >
            <div @click.away="showAdjustModal = false" class="w-full max-w-lg rounded-[28px] bg-white p-6 shadow-2xl">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-900">Adjust Stock</h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Set exact quantity for <span class="font-semibold text-slate-700" x-text="selectedStock.item_name"></span>
                    </p>
                </div>

                <form :action="adjustAction" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Current Quantity</label>
                        <input type="text" :value="selectedStock.quantity + ' ' + selectedStock.unit" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600" readonly>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">New Quantity</label>
                        <input type="number" name="new_quantity" min="0" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" required>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-slate-700">Remarks</label>
                        <textarea name="remarks" rows="3" class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Reason for adjustment" required></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <button type="button" @click="showAdjustModal = false" class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                            Confirm Adjustment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function stockPage() {
            return {
                showCreateModal: false,
                showStockInModal: false,
                showStockOutModal: false,
                showAdjustModal: false,

                selectedStock: {
                    id: null,
                    item_name: '',
                    quantity: 0,
                    unit: 'pcs',
                },

                get stockInAction() {
                    return this.selectedStock.id ? `/stocks/${this.selectedStock.id}/stock-in` : '#';
                },

                get stockOutAction() {
                    return this.selectedStock.id ? `/stocks/${this.selectedStock.id}/stock-out` : '#';
                },

                get adjustAction() {
                    return this.selectedStock.id ? `/stocks/${this.selectedStock.id}/adjust` : '#';
                },

                openCreateModal() {
                    this.showCreateModal = true;
                },

                openStockInModal(stock) {
                    this.selectedStock = stock;
                    this.showStockInModal = true;
                },

                openStockOutModal(stock) {
                    this.selectedStock = stock;
                    this.showStockOutModal = true;
                },

                openAdjustModal(stock) {
                    this.selectedStock = stock;
                    this.showAdjustModal = true;
                },
            }
        }
    </script>
</x-layouts.its_layout>