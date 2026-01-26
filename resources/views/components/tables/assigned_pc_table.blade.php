@props(['pcs'])
<div class="bg-white rounded-xl max-w-full overflow-x-hidden">
    <div class="w-full max-w-full">
        <form action="/assigned-pc" method="GET">
            <div class="flex gap-4 mb-4 min-w-0 items-center">
                <input
                        value="{{ request('serial_number') }}"
                        type="text"
                        name="assigned_to"
                        placeholder="Search name..."
                        class="flex-2 w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none col-span-3"
                    />
                    <select name="asset_type" class="flex-1 w-52 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none">
                        <option value="" {{ request('asset_type') ? '' : 'selected' }}>Asset Type</option>
                        <option value="system_unit" {{ request('asset_type') == 'system_unit' ? 'selected' : '' }}>System Unit</option>
                        <option value="monitor" {{ request('asset_type') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                    </select>

                    {{-- <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none">
                        <option value="" {{ request('status') == '' ? 'selected' : '' }}>Status</option>
                        <option value="Available" {{ request('status') == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Borrowed" {{ request('status') == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                        <option value="Damaged" {{ request('status') == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                    </select> --}}
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600">Filter</button>
            </div>
        </form>
    </div>
    <div class="relative max-w-full overflow-x-auto rounded-md border border-gray-300">
        <table class="min-w-full w-full text-sm text-left border-collapse  ">
            <thead>
                <tr class="bg-slate-300 text-gray-700 uppercase text-xs border-b border-gray-300">
                    <th class="px-4 py-3 whitespace-nowrap">Assigned To</th>
                    <th class="px-4 py-3 whitespace-nowrap">System Unit</th>
                    <th class="px-4 py-3 whitespace-nowrap">Monitor</th>
                    <th class="px-4 py-3 whitespace-nowrap">status</th>
                    <th class="px-4 py-3 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pcs as $pc)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $pc->assigned_to }}</td>
                        <td class="px-4 py-3">{{ $pc->systemUnit->serial_number }}</td>
                        <td class="px-4 py-3">{{ $pc->monitor->serial_number }}</td>
                        <td class="px-4 py-3">{{ $pc->status }}</td>
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
