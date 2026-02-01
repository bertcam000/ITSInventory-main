{{-- <x-layouts.layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{form: false, fmodal: ''}">
        <button @click="form = true" class="mb-5 px-3 py-2 rounded-md bg-black text-white">Create New Asset</button>
        <div>
            <x-tables.table :assets="$assets"/>
        </div>

        
        <div x-show="form" x-cloak class="fixed inset-0 bg-black/40 flex items-center justify-center">
            <div @click.away="form = false" class="bg-white rounded-lg shadow-lg w-80 p-6 text-center">
                <h2 class="text-lg font-medium text-gray-800 mb-6">
                    Choose
                </h2>
                <div class="flex gap-3">
                    <button @click="fmodal = 'su' ; form = false" class="flex-1 border border-gray-300 rounded-md py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        System Unit
                    </button>

                    <button @click="fmodal = 'monitor' ; form = false" class="flex-1 border border-gray-300 rounded-md py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                        Monitor
                    </button>
                </div>
            </div>
        </div>

        

        <div x-show="fmodal === 'su'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <livewire:test.test/>
        </div>
        <div x-show="fmodal === 'monitor'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <livewire:inventory.monitor-form/>
        </div>
        
    </div>
</x-layouts.layout> --}}

<x-layouts.its_layout>

    <section class="space-y-6" x-data="{addAssetModalOpen: false}">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Asset Management</h1>
        </div>
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <button @click="addAssetModalOpen = true" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
            + Add Asset
          </button>
          <p class="text-sm font-medium text-gray-600">
            Total Assets 
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['total'] }}
            </span>
          </p>
        </div>

        <!-- Asset overview by type -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Desktop PCs</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['system_unit'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Lab units and office workstations</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Laptops</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['laptop'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Issued to faculty and staff</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Monitors</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['monitor'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Wireless coverage per building</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Printers & Others</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['printer'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Printers, scanners, and peripherals</p>
          </div>
        </div>

        <!-- Current asset list -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Current Asset Total {{ $statusCards['total'] }}</h2>
            <form action="/inventory" method="GET">
                <div class="flex items-center gap-3">
                    <input type="text" id="serial_number" name="serial_number" placeholder="Search serial number..." class="text-sm border border-gray-300 rounded px-3 w-48 py-1">
                    <select name="asset_type" id="asset_type" wire:model.live="asset_type" class="text-sm border border-gray-300 rounded px-3 w-36 py-1">
                        <option value="" {{ request('asset_type') ? '' : 'selected' }}>All Types</option>
                        <option value="system_unit" {{ request('asset_type') == 'system_unit' ? 'selected' : '' }}>System Unit</option>
                        <option value="laptop" {{ request('asset_type') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="monitor" {{ request('asset_type') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="printer" {{ request('asset_type') == 'printer' ? 'selected' : '' }}>Printer</option>
                        <option value="keyboard" {{ request('asset_type') == 'keyboard' ? 'selected' : '' }}>Keyboard</option>
                        <option value="mouse" {{ request('asset_type') == 'mouse' ? 'selected' : '' }}>Mouse</option>
                    </select>
                    <select name="status" id="status" wire:model.live="status" class="text-sm border border-gray-300 rounded px-3 w-36 py-1">
                        <option value="" {{ request('status') ? '' : 'selected' }}>All Statuses</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                    </select>
                    <button class="bg-primary text-white px-3 py-1 rounded text-sm">Search</button>
                </div>
            </form>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Item</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Serial Number</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Brand</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Model</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Specs</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @forelse ($assets as $asset)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-900">{{ $asset->asset_type }}</td>
                    <td class="px-6 py-4 text-gray-900">{{ $asset->serial_number }}</td>
                    <td class="px-6 py-4 text-gray-900">{{ $asset->brand }}</td>
                    <td class="px-6 py-4 text-gray-900">{{ $asset->model }}</td>
                    <td class="px-6 py-4 text-gray-900">
                        @if ($asset->asset_type === 'system_unit')
                            <div> {{ $asset->systemUnitSpec->processor }}</div>
                            <div> {{ $asset->systemUnitSpec->memory . ' / ' . $asset->systemUnitSpec->storage}}</div>
                            <div> {{ $asset->systemUnitSpec->videocard }}</div>
                            @elseif ($asset->asset_type === 'monitor')
                            <div>Size: {{ $asset->monitorSpec->size }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-900">{{ $asset->status }}</td>
                    <td class="px-6 py-4"><button class="text-primary hover:text-primaryDark text-xs font-medium">View →</button></td>
                </tr>
                @empty
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No Data Found</td>
                @endforelse
              </tbody>
            </table>
            <div class="p-4">
                {{ $assets->links() }}
            </div>
          </div>
        </div>

        <!-- Asset movement logs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-900 uppercase tracking-wide">Asset Movement Logs</h2>
            <span class="text-xs text-gray-500">Recently issued, returned, and transferred items</span>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Asset</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Type</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Campus</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Movement</th>
                  <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Reference</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="px-6 py-4 text-gray-600 whitespace-nowrap">Jan 26, 2026 – 09:15 AM</td>
                  <td class="px-6 py-4 font-medium text-gray-900">Dell Laptop - IT-001</td>
                  <td class="px-6 py-4 text-gray-600">Laptop</td>
                  <td class="px-6 py-4 text-gray-600">Main Campus</td>
                  <td class="px-6 py-4">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                      Issued to faculty
                    </span>
                  </td>
                  <td class="px-6 py-4 text-gray-600">Ticket #1023</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        {{-- MODAl --}}
        <div x-show="addAssetModalOpen" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed -top-6 left-0 z-50  justify-center items-center">
            <livewire:test.test/>
        </div>
      </section>
    
</x-layouts.its_>