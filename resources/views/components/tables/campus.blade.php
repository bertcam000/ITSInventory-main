{{-- @props(['departments']) --}}
<div class="bg-white rounded-xl max-w-full overflow-x-hidden">
    <div class="w-full max-w-full">
        <form action="/department" method="GET">
            <div class="flex gap-4 mb-4 min-w-0 items-center">
                <input
                        value="{{ request('name') }}"
                        type="text"
                        name="name"
                        placeholder="Search items..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
                    />
                    <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600">Search</button>
            </div>
        </form>
    </div>
    <div class="relative max-w-full overflow-x-auto rounded-md border border-gray-300">
        <table class="min-w-full w-full text-sm text-left border-collapse  ">
            <thead>
                <tr class="bg-slate-300 text-gray-700 uppercase text-xs border-b border-gray-300">
                    <th class="px-4 py-3 whitespace-nowrap">Id</th>
                    <th class="px-4 py-3 whitespace-nowrap">Department Name</th>
                    <th class="px-4 py-3 whitespace-nowrap">Employees</th>
                    <th class="px-4 py-3 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @forelse ($departments as $department) --}}
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">Main</td>
                        <td class="px-4 py-3">Main</td>
                        <td class="px-4 py-3">
                            main
                        </td>
                        <td class="px-4 py-3">
                            <button class="text-blue-600 hover:underline">View</button>
                        </td>
                    </tr>
                {{-- @empty
                    
                @endforelse --}}
            </tbody>
        </table>
    </div>
</div>
