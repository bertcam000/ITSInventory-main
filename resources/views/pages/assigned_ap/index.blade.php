<x-layouts.its_layout>

    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif

    <div x-data="{form: false}">

        <section class="space-y-6">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">
                    Access Point Assignment
                </h1>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <button
                    @click="form = true"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
                    + Assign Access Point
                </button>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="p-4 border-b border-gray-200 flex items-center justify-between">

                    <div>
                        <button
                            onclick="window.print()"
                            class="bg-primary text-white px-3 py-1 rounded text-sm">
                            Print
                        </button>
                    </div>

                    <form
                        action="/assigned-ap"
                        method="GET"
                        class="flex flex-col gap-3 sm:flex-row sm:items-center justify-between items-center w-full">

                        <select
                            onchange="this.form.submit()"
                            name="pages"
                            class="text-sm border border-gray-300 rounded px-3 py-1 mx-3 w-[60px]">

                            <option value="10" {{ request('pages') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('pages') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('pages') == '50' ? 'selected' : '' }}>50</option>

                        </select>

                        <div class="flex gap-2">

                            <input
                                type="text"
                                value="{{ request('search') }}"
                                name="search"
                                placeholder="Search asset tag..."
                                class="text-sm border border-gray-300 rounded px-3 w-48 py-1"/>

                            <select
                                name="campus"
                                class="text-sm border border-gray-300 rounded px-3 w-36 py-1"
                                onchange="this.form.submit()">

                                <option value="">All Campus</option>

                                @foreach($campuses as $campus)
                                    <option
                                        value="{{ $campus->id }}"
                                        {{ request('campus') == $campus->id ? 'selected' : '' }}>
                                        {{ $campus->name }}
                                    </option>
                                @endforeach

                            </select>

                            <select
                                name="department"
                                class="text-sm border border-gray-300 rounded px-3 w-36 py-1"
                                onchange="this.form.submit()">

                                <option value="">All Departments</option>

                                @foreach($locations as $location)
                                    <option
                                        value="{{ $location->id }}"
                                        {{ request('location') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach

                            </select>

                            <div>

                                <button
                                    class="bg-primary text-white px-3 py-1 rounded text-sm">
                                    Search
                                </button>

                                <a
                                    href="/assigned-ap"
                                    class="text-black border border-gray-300 px-3 py-1 rounded text-sm">
                                    Reset
                                </a>

                            </div>

                        </div>

                    </form>

                </div>

                <div id="print-area" class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                    Asset Tag
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                    Serial Number
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                    Department
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">
                                    Campus
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase no-print">
                                    Action
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse ($assignments as $assignment)

                                <tr
                                    class="hover:bg-gray-50 transition-colors"
                                    x-data="{ open: false, dl: false }">

                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $assignment->asset_tag }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $assignment->asset->serial_number }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $assignment->department->name ?? 'NA' }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $assignment->department->campus->name ?? 'NA' }}
                                    </td>

                                    <td class="px-6 py-4 relative no-print">

                                        <button
                                            @click="open = !open"
                                            class="px-3 py-1 rounded-md hover:bg-gray-100">
                                            ⋮
                                        </button>

                                        <div
                                            x-show="open"
                                            x-cloak
                                            @click.away="open = false"
                                            class="absolute right-14 top-3 py-2 px-3 flex gap-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50">

                                            <button
                                                @click="dl = true"
                                                class="text-red-500 hover:bg-gray-200 hover:rounded-lg px-2">
                                                Delete
                                            </button>

                                            <a
                                                href="/access-point-assignments/{{ $assignment->id }}/edit"
                                                class="hover:bg-gray-200 hover:rounded-lg px-2">
                                                Edit
                                            </a>

                                            <a
                                                href="/access-point-assignments/{{ $assignment->id }}"
                                                class="text-green-500 hover:rounded-lg hover:bg-gray-200 px-2">
                                                View
                                            </a>

                                        </div>

                                        <div
                                            x-show="dl"
                                            x-cloak
                                            class="fixed inset-0 flex items-center justify-center z-50">

                                            <div
                                                class="fixed inset-0 bg-black bg-opacity-50"
                                                @click="dl = false"></div>

                                            <div
                                                class="bg-white rounded-lg shadow-lg w-96 p-6 z-50">

                                                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                                                    Delete Confirmation
                                                </h2>

                                                <p class="text-gray-600 mb-6">
                                                    Are you sure? This assignment will permanently be deleted
                                                </p>

                                                <div class="flex justify-end gap-3">

                                                    <button
                                                        @click="dl = false"
                                                        class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                                                        Cancel
                                                    </button>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('access-point-assignments.destroy', $assignment->asset_tag) }}">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="px-4 py-2 rounded bg-red-500 hover:bg-red-600 text-white">
                                                            Delete
                                                        </button>

                                                    </form>

                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        No Data Found
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                    <div class="p-4">
                        {{ $assignments->links() }}
                    </div>

                </div>

            </div>

        </section>

        <div x-show="form" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <div @click.away="form = false" class=" rounded-lg">
                <livewire:ap_assignment.create/>
            </div>
        </div>

    </div>

</x-layouts.its_layout>