@props(['departments', 'totalDepartments', 'campuses'])
<section class="space-y-6">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Departments Management</h1>
    </div>    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <button @click="form = true" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
        + Add New Department
        </button>

        <!-- Stats Strip -->
        <div class="px-4 pt-4">
            <div class="flex flex-wrap items-center gap-2">
                <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-gray-50 px-3 py-2">
                    <span class="text-xs font-medium text-gray-500">Total Departments</span>
                    <span class="h-4 w-px bg-gray-200"></span>
                    <span class="text-sm font-semibold text-gray-900">{{ $totalDepartments  }}</span>
                </div>

                @foreach ($campuses as $campus)
                    <div class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-3 py-2">
                        <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-medium text-gray-500">{{ $campus->name }}</span>
                        <span class="ml-1 text-sm font-semibold text-gray-900">{{ $campus->department_count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
        <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Current Department List </h2>
        <form action="/department" method="GET">
            <div class="flex items-center gap-3">
                <input
                    type="text"
                    name="name"
                    value="{{ request('name') }}"
                    placeholder="Search department name..."
                    class="text-sm border border-gray-300 rounded px-3 w-48 py-1"
                >

                <select
                    name="campus"
                    class="text-sm border border-gray-300 rounded px-3 w-36 py-1"
                >
                    <option value="">Campus</option>

                    @foreach ($campuses as $campus)
                        <option
                            value="{{ $campus->id }}"
                            {{ request('campus') == $campus->id ? 'selected' : '' }}
                        >
                            {{ $campus->name }}
                        </option>
                    @endforeach
                </select>

                <button class="bg-primary text-white px-3 py-1 rounded text-sm">
                    Search
                </button>
            </div>
        </form>

        </div>
        <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Departments</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Campus</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assigned Assets</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse ($departments as $department)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-gray-900">{{ $department->name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $department->campus->name }}</td>
                <td class="px-6 py-4 text-gray-900">{{ $department->PcAssignments->count() }}</td>
                <td class="px-6 py-4"><a href="/assigned-pc/{{ $department->id }}" class="text-primary hover:text-primaryDark text-xs font-medium">View →</a></td>
            </tr>
            @empty
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No Data Found</td>
            @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $departments->links() }}
        </div>
        </div>
    </div>
</section>