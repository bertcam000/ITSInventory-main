<x-layouts.its_layout>

    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <a
                        href="{{ route('stocks.index') }}"
                        class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-600 shadow-sm transition hover:bg-slate-100"
                    >
                        ← Back
                    </a>

                    <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">Edit Stock Item</h1>
                    <p class="mt-1 text-sm text-slate-500">Update the stock item details. Quantity changes should use stock movement actions.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
                <form action="{{ route('stocks.update', $stock->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Item Name</label>
                            <input
                                type="text"
                                name="item_name"
                                value="{{ old('item_name', $stock->item_name) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Item Code</label>
                            <input
                                type="text"
                                name="item_code"
                                value="{{ old('item_code', $stock->item_code) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
                            <input
                                type="text"
                                name="category"
                                value="{{ old('category', $stock->category) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Brand</label>
                            <input
                                type="text"
                                name="brand"
                                value="{{ old('brand', $stock->brand) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Model</label>
                            <input
                                type="text"
                                name="model"
                                value="{{ old('model', $stock->model) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Unit</label>
                            <input
                                type="text"
                                name="unit"
                                value="{{ old('unit', $stock->unit) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Minimum Stock</label>
                            <input
                                type="number"
                                name="minimum_stock"
                                min="0"
                                value="{{ old('minimum_stock', $stock->minimum_stock) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-slate-700">Location</label>
                            <input
                                type="text"
                                name="location"
                                value="{{ old('location', $stock->location) }}"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                required
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-slate-700">Specification</label>
                            <textarea
                                name="specification"
                                rows="4"
                                class="w-full rounded-2xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >{{ old('specification', $stock->specification) }}</textarea>
                        </div>
                    </div>

                    <!-- Quantity Info Notice -->
                    <div class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-700">
                        Current Quantity: <span class="font-semibold">{{ $stock->quantity }} {{ $stock->unit }}</span><br>
                        Use <span class="font-semibold">Stock In</span>, <span class="font-semibold">Stock Out</span>, or <span class="font-semibold">Adjust</span> to change quantity.
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a
                            href="{{ route('stocks.index') }}"
                            class="rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
                        >
                            Update Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.its_layout>