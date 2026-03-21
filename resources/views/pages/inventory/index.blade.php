<x-layouts.its_layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif

    <section class="space-y-6" x-data="{addAssetModalOpen: false}">
        {{-- <div>
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
        </div> --}}

        <div class=" lg:flex justify-between items-center">
          <div class='space-y-1'>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Asset Management</h1>
            <p class="text-sm text-gray-600">
            Total Assets 
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['total'] }}
            </span>
          </p>
          </div>
          <button @click="addAssetModalOpen = true" class="w-full lg:w-auto bg-primary text-white px-4 py-2 rounded-lg hover:bg-primaryDark transition-colors text-sm font-medium">
            + Add Asset
          </button>
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
            <p class="text-xs text-gray-500">Total monitor</p>
          </div>
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-sm font-medium text-gray-600">Access Points</h3>
              <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary/10 text-primary text-sm font-semibold">
                {{ $statusCards['access_point'] }}
              </span>
            </div>
            <p class="text-xs text-gray-500">Total Accesspoint</p>
          </div>
        </div>

        <!-- Current asset list -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <div>
              <button onclick="window.print()" class="bg-primary text-white px-3 py-1 rounded text-sm">Print</button>
            </div>
            <form action="/inventory" method="GET" class="flex justify-between items-center w-full">
              <select onchange="this.form.submit()" name="pages" id="rowsPerPage" class="text-sm border border-gray-300 rounded px-3 w-36 py-1 mx-3 w-[60px]">
                <option value="10" {{ request('pages') == '10' ? 'selected' : '' }} selected>10</option>
                <option value="25" {{ request('pages') == '25' ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('pages') == '50' ? 'selected' : '' }}>50</option>
              </select>
                <div class="flex items-center gap-3">
                    <input onchange="this.form.submit()" type="text" value="{{ request('serial_number') }}" id="serial_number" name="serial_number" placeholder="Search serial number..." class="text-sm border border-gray-300 rounded px-3 w-48 py-1">
                    <select onchange="this.form.submit()" name="asset_type" id="asset_type" wire:model.live="asset_type" class="text-sm border border-gray-300 rounded px-3 w-36 py-1">
                        <option value="" {{ request('asset_type') ? '' : 'selected' }}>All Types</option>
                        <option value="system_unit" {{ request('asset_type') == 'system_unit' ? 'selected' : '' }}>System Unit</option>
                        <option value="laptop" {{ request('asset_type') == 'laptop' ? 'selected' : '' }}>Laptop</option>
                        <option value="monitor" {{ request('asset_type') == 'monitor' ? 'selected' : '' }}>Monitor</option>
                        <option value="printer" {{ request('asset_type') == 'printer' ? 'selected' : '' }}>Printer</option>
                        <option value="access_point" {{ request('asset_type') == 'access_point' ? 'selected' : '' }}>Access Point</option>
                    </select>
                    <select onchange="this.form.submit()" name="status" id="status" wire:model.live="status" class="text-sm border border-gray-300 rounded px-3 w-36 py-1">
                        <option value="" {{ request('status') ? '' : 'selected' }}>All Statuses</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                    </select>
                    <button class="bg-primary text-white px-3 py-1 rounded text-sm">Search</button>
                    <a
                        href="/inventory"
                        class="text-black border border-gray-300 px-3 py-1 rounded text-sm">
                        Resets
                    </a>
                </div>
            </form>
          </div>
  
          

          <div id="print-area" class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base ">
              <table id="qr-print-area" class="w-full text-sm text-left rtl:text-right text-body">
                  <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <div class="text-end px-5 py-2  print-date">{{ now()->format('M d, Y') }}</div>
                      <tr>
                          <th scope="col" class="px-6 py-3 font-medium">Asset</th>
                          <th scope="col" class="px-6 py-3 font-medium">Serial Number</th>
                          <th scope="col" class="px-6 py-3 font-medium">Brand</th>
                          <th scope="col" class="px-6 py-3 font-medium">Model</th>
                          <th scope="col" class="px-6 py-3 font-medium">Specs</th>
                          <th scope="col" class="px-6 py-3 font-medium text-center">Status</th>
                          <th scope="col" class="px-6 py-3 font-medium no-print">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @forelse ($assets as $asset)
                      <tr class="bg-neutral-primary border-b border-default" x-data="{ open: false, dl: false }">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">{{ Str::title(str_replace('_', ' ', $asset->asset_type)) }}</th>
                        <td class="px-6 py-4">{{ $asset->serial_number }}</td>
                        <td class="px-6 py-4">{{ $asset->brand }}</td>
                        <td class="px-6 py-4">{{ $asset->model }}</td>
                        <td class="px-6 py-4 text-xs">
                            @if ($asset->asset_type === 'system_unit' || $asset->asset_type === 'laptop') 
                              {{ $asset->systemUnitSpec->processor }} |
                              {{ $asset->systemUnitSpec->memory . ' | ' . $asset->systemUnitSpec->storage }} |
                              {{ $asset->systemUnitSpec->videocard }}
                            @elseif ($asset->asset_type === 'monitor')
                                <div>Size: {{ $asset->monitorSpec->size }}</div>
                            @else
                                <div>NA</div>
                            @endif
                        </td>
                        <td class="px-6 py-4"><div class=" text-center text-black rounded-lg py-1 {{ $asset->status === 'assigned' ? 'bg-blue-300 text-blue-900 font-semibold' : 'bg-green-300 text-green-900 font-semibold' }}">{{ $asset->status }}</div></td>
                        <td class="px-6 py-4 relative no-print">
                          <button @click="open = !open" class="px-3 py-1 rounded-md hover:bg-gray-100">
                              ⋮
                          </button>

                          <div x-show="open" x-cloak @click.away="open = false" x-transition class="absolute right-14 top-3 py-2 px-3 flex justify-center items-center gap-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                              @can('view-page')
                                <button @click="dl = true" class="text-red-500 hover:bg-gray-200 hover:rounded-lg px-2">Delete</button>
                              @endcan
                              <a href="/asset/update/{{ $asset->id }}" class=" hover:bg-gray-200 hover:rounded-lg px-2">Edit</a>
                              <a href="/inventory/result/{{ $asset->id }}" class="text-green-500 hover:rounded-lg hover:bg-gray-200 px-2">View</a>
                          </div>

                          <div x-show="dl" x-cloak
                              class="fixed inset-0 flex items-center justify-center z-50">
                              
                              <div class="fixed inset-0 bg-black bg-opacity-50" @click="dl = false"></div>

                              <div class="bg-white rounded-lg shadow-lg w-96 p-6 z-50"
                                  x-transition:enter="transition ease-out duration-300"
                                  x-transition:enter-start="opacity-0 scale-90"
                                  x-transition:enter-end="opacity-100 scale-100"
                                  x-transition:leave="transition ease-in duration-200"
                                  x-transition:leave-start="opacity-100 scale-100"
                                  x-transition:leave-end="opacity-0 scale-90">

                                  <h2 class="text-lg font-semibold text-gray-800 mb-4">Delete Confirmation</h2>
                                  <p class="text-gray-600 mb-6">Are you sure? This asset will permanently deleted</p>

                                  <div class="flex justify-end gap-3">
                                      <button @click="dl = false" 
                                              class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                                          Cancel
                                      </button>

                                      <form method="POST" action="/asset/delete/{{ $asset->id }}">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" 
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
                          <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                              No Data Found
                          </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
                
                <div class="p-4 no-print">
                  {{ $assets->links() }}
                </div>
            </div>
            {{--  --}}
          
        </div>

        <!-- Asset movement logs -->
        {{-- <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
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
        </div> --}}
        {{-- MODAl --}}
        <div x-show="addAssetModalOpen" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed -top-6 left-0 z-50  justify-center items-center">
            <livewire:test.test/>
        </div>
      </section>
    

<style>
  .print-date {
      display: none;
  }
  @media print {

      body * {
          visibility: hidden;
          font-size: 10px !important;
      }
      

      .print-date {
          display: block;
          font-size: 12px;
      }

      #print-area,
      #print-area * {
          visibility: visible;
      }

      #print-area {
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
      }

      .no-print {
          display: none !important;
      }

      table {
          border-collapse: collapse;
      }

      th, td {
          
          border: 1px solid #000;
          padding: 3px 4px !important;   
          line-height: 1.1 !important;   
          vertical-align: top !important;
      }

      tr {
          height: auto !important;
      }

      td br {
          line-height: 1 !important;
      }

      th {
          background: #f3f3f3 !important;
          color: #000 !important;
      }
  }
</style>
      
</x-layouts.its_>