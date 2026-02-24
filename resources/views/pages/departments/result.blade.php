{{-- <x-layouts.its_layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{form: false, fmodal: ''}">
        <div>
           @foreach ($department->pcAssignments as $assignment)
            <p>
                {{ $assignment->systemUnit->serial_number }}
            </p>
        @endforeach
        </div>
    </div>
</x-layouts.its_layout> --}}

<x-layouts.its_layout>
    <section class="space-y-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $department->name }} PC Assignments</h1>
        </div>    
        {{-- <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <button @click="form = true" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
            + Add New Department
            </button>
        </div> --}}

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Current Department List </h2>
            <form method="GET">
                <div class="flex items-center gap-3">
                    <input
                        type="text"
                        name="name"
                        value="{{ request('name') }}"
                        placeholder="Search department name..."
                        class="text-sm border border-gray-300 rounded px-3 w-48 py-1"
                    >
                    <button type="submit" class="bg-primary text-white px-3 py-1 rounded text-sm">
                        Search
                    </button>
                    <a href="/department/result/{{ $department->id }}"
                        class="px-4 py-2 border rounded-lg">
                        Reset
                    </a>
                </div>
            </form>

            </div>
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Asset ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assigned To</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Campus</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Assigned Assets</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Action</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($pcAssignments as $assignment)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-900">
                        {{ $assignment->asset_id }}
                    </td>

                    <td class="px-6 py-4 text-gray-900">
                        {{ $assignment->assigned_to }}
                    </td>

                    <td class="px-6 py-4 text-gray-900">
                        {{ $department->campus->name }}
                    </td>

                    <td class="px-6 py-4 text-gray-900">
                        {{ $pcAssignments->total() }}
                    </td>

                    <td class="px-6 py-4">
                        <a href="/inventory/result/{{ $assignment->systemUnit->id }}"
                        class="text-primary hover:text-primaryDark text-xs font-medium">
                        View →
                        </a>
                    </td>
                </tr>

                @empty
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                No Data Found
                </td>
                @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $pcAssignments->withQueryString()->links() }}
            </div>
            </div>
        </div>
    </section>
</x-layouts.its_layout>
