@props(['pcs'])
<section class="space-y-6">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">PC Assignment</h1>
    </div>    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <button @click="form = true" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
        + Assign PC
        </button>
    </div>
    

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Current Department List </h2>
        <form action="/assigned-pc" method="GET">
            <div class="flex items-center gap-3">
                <input type="text" value="{{ request('name') }}" id="name" name="name" placeholder="Search asset tag..." class="uppercase-input text-sm border border-gray-300 rounded px-3 w-48 py-1">
                {{-- <select name="department" id="campus" class="text-sm border border-gray-300 rounded px-3 w-36 py-1">
                    <option value="" {{ request('department') ? '' : 'selected' }}>Department</option>
                    <option value="system_unit" {{ request('campus') == 'Main' ? 'selected' : '' }}>Main</option>
                    <option value="keyboard" {{ request('campus') == 'Annex' ? 'selected' : '' }}>Annex</option>
                    <option value="mouse" {{ request('campus') == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                </select> --}}
                <button class="bg-primary text-white px-3 py-1 rounded text-sm">Search</button>
            </div>
        </form>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Asset Tag</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assigned To</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Department</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Campus</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Date Assigned</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse ($pcs as $pc)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-900">{{ $pc->asset_id }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->assigned_to }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->department->name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->department->campus->name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4"><button class="text-primary hover:text-primaryDark text-xs font-medium">View →</button></td>
            </tr>
            @empty
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No Data Found</td>
            @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $pcs->links() }}
        </div>
    </div>

    
</section>
