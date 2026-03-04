@props(['pcs', 'departments', 'campuses'])
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
            <form action="/assigned-pc" method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <input type="text" value="{{ request('name') }}" id="name" name="name" placeholder="Search employee / serial / asset tag..." class="text-sm border border-gray-300 rounded px-3 w-48 py-1"/>
                <select name="campus" id="campus" class="text-sm border border-gray-300 rounded px-3 w-36 py-1" onchange="this.form.submit()">
                    <option value="">All Campus</option>
                    @foreach($campuses as $campus)
                    <option value="{{ $campus->id }}" {{ request('campus') == $campus->id ? 'selected' : '' }}>
                        {{ $campus->name }}
                    </option>
                    @endforeach
                </select>

                <select name="department" id="department" class="text-sm border border-gray-300 rounded px-3 w-36 py-1" onchange="this.form.submit()">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>

                <div class="flex gap-2">
                    <button class="bg-primary text-white px-4 py-2 rounded text-sm font-medium">Filter</button>
                    <a href="/assigned-pc" class="border border-gray-300 px-4 py-2 rounded text-sm font-medium">Reset</a>
                </div>
            </form>
        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Asset Tag</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assigned To</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assets</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Department</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Campus</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse ($pcs as $pc)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-900">{{ $pc->asset_id }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->assigned_to }}</td>
                <td class="px-6 py-4 text-gray-900 ">{{ $pc->systemUnit->serial_number .' | ' . $pc->monitor->serial_number }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->department->name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $pc->department->campus->name }}</td>
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
