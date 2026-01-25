@props(['assets'])
<div class="bg-white rounded-xl max-w-full overflow-x-hidden">
    <div class="w-full max-w-full">
        <form action="/inventory" method="GET">
            <div class="grid grid-cols-6 gap-4 mb-4 min-w-0 items-center">
                <input
                        value="{{ request('serial_number') }}"
                        type="text"
                        name="serial_number"
                        placeholder="Search items..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none col-span-3"
                    />

                    <select name="asset_type" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none">
                        <option value="" {{ request('asset_type') ? '' : 'selected' }}>Asset Type</option>
                        <option value="system_unit" {{ request('asset_type') == 'system_unit' ? 'selected' : '' }}>System Unit</option>
                        <option value="monitor" {{ request('asset_type') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                    </select>

                    <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Status</option>
                        <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                        <option value="Damaged" {{ request('status') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                    </select>


                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600">Filter</button>

            </div>
        </form>
    </div>
    <!-- Table Wrapper -->
    <div class="relative max-w-full overflow-x-auto rounded-md border border-gray-300">
        <table class="min-w-full w-full text-sm text-left border-collapse  ">
            <thead>
                <tr class="bg-slate-300 text-gray-700 uppercase text-xs border-b border-gray-300">
                    <th class="px-4 py-3 whitespace-nowrap">Item</th>
                    <th class="px-4 py-3 whitespace-nowrap">Serial Number</th>
                    <th class="px-4 py-3 whitespace-nowrap">Brand</th>
                    <th class="px-4 py-3 whitespace-nowrap">Model</th>
                    <th class="px-4 py-3 whitespace-nowrap">Specs</th>
                    <th class="px-4 py-3 whitespace-nowrap">Status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $asset)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $asset->asset_type }}</td>
                        <td class="px-4 py-3">{{ $asset->serial_number }}</td>
                        <td class="px-4 py-3">{{ $asset->brand }}</td>
                        <td class="px-4 py-3">{{ $asset->model }}</td>
                        <td class="px-4 py-3">
                            @if ($asset->asset_type === 'system_unit')
                                <div>Memory: {{ $asset->systemUnitSpec->memory }}</div>
                                <div>Storage: {{ $asset->systemUnitSpec->storage }}</div>
                                <div>GPU: {{ $asset->systemUnitSpec->videocard }}</div>
                                @elseif ($asset->asset_type === 'monitor')
                                <div>Size: {{ $asset->monitorSpec->size }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                {{ $asset->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:underline">View</button>
                        </td>
                    </tr>
                @empty
                    
                @endforelse
                
            </tbody>
        </table>
    </div>
</div>
