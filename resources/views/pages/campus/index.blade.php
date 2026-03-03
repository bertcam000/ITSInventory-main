<x-layouts.its_layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{campusForm: false}" class="space-y-6">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Campus Management</h1>
        </div>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <button @click="campusForm = true" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
            + Add Campus
          </button>
          <p class="text-sm font-medium text-gray-600">
            Total Campus 
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $stats['total_campus'] }}
            </span>
          </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Total Campus</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $stats['total_campus'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Lab units and office workstations</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Total Departments</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $stats['total_departments'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Issued to faculty and staff</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Total Asset Deployed</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $stats['total_assets'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Wireless coverage per building</p>
          </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Campus Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Location
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Departments
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">

                  @forelse ($stats['campus'] as $campus)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">
                            {{ $campus->name }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $campus->location }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ count($campus->department) }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm space-x-3">
                            <button class="text-indigo-600 hover:text-indigo-800 font-medium">
                                Edit
                            </button>
                            <button class="text-red-500 hover:text-red-700 font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                  @empty
                    
                  @endforelse
                </tbody>
            </table>
        </div>
        
        <div x-show="campusForm" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed -top-6 left-0 z-50  justify-center items-center">
            <div @click.away="campusForm = false" class=" rounded-lg">
                <livewire:campus.components.form/>
            </div>
        </div>
    </div>
</x-layouts.its_layout>