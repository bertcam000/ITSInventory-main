<x-layouts.solo-layout>

    @php
        $assetTitle = trim(($asset->brand ?? '').' '.($asset->model ?? '')) ?: 'Asset';
        $serial     = $asset->serial_number ?? 'NA';
        $status     = $asset->status ?? 'NA';
        $type       = $asset->asset_type ?? 'NA';

        // Specs: pick based on type
        $spec = null;
        if ($type === 'system_unit' | $type === 'laptop') $spec = $asset->systemUnitSpec ?? null;
        if ($type === 'monitor')     $spec = $asset->monitorSpec ?? null;

        // Assignment (safe)
        $deptName   = $assignment?->department?->name ?? 'NA';
        $campusName = $assignment?->department?->campus?->name ?? 'NA';

        $su         = $assignment?->systemUnit;
        $mon        = $assignment?->monitor;

        $suSerial   = $su?->serial_number ?? '—';
        $suName     = trim(($su?->brand ?? '').' '.($su?->model ?? '')) ?: 'NA';

        $monSerial  = $mon?->serial_number ?? '—';
        $monName    = trim(($mon?->brand ?? '').' '.($mon?->model ?? '')) ?: 'NA';

        // Example spec fields (adjust to your columns)
        $cpu        = $spec->processor ?? null;
        $ram        = $spec->memory ?? null;
        $storage    = $spec->storage ?? null;
        $graphics   = $spec->videocard ?? null;

        $monitorSize = $spec->size ?? null;
        $resolution  = $spec->resolution ?? null;

        $createdAt  = optional($asset->created_at)->format('M d, Y') ?? 'NA';
        $updatedAt  = optional($asset->updated_at)->format('M d, Y') ?? 'NA';

        // QR value
        $qrUrl = $asset->qr_url ?? url('/inventory/result/'.$asset->id);
    @endphp
    
  <div class="min-h-screen">

    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/80 backdrop-blur">
      <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between py-4">
          <div class="flex items-start gap-3">
            <a href="{{ url()->previous() }}" class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50">
              <!-- back -->
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M15 18l-6-6 6-6"></path>
              </svg>
            </a>
            <div>
              <h1 class="text-lg sm:text-xl font-semibold tracking-tight">Asset Info</h1>
              <p class="text-xs sm:text-sm text-slate-500">Update asset info, status, and assignments.</p>
            </div>
          </div>

          <div class="hidden sm:flex items-center gap-2">
            <a href="/asset/update/{{ $asset->id }}" type="submit" form="editAssetForm"
              class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
              Edit Asset
            </a>
          </div>
        </div>
      </div>
    </header>
    
    <main class="max-w-4xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
      
      <!-- Back -->
      {{-- <div class="mb-6">
        <a href="#" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
          </svg>
          Back
        </a>
      </div> --}}

      <!-- Main Card -->
      <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Header -->
        <div class="px-5 py-4 border-b border-gray-200">
          <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div>
              <p class="text-xs uppercase tracking-wide text-gray-500">Asset Info</p>
              <h1 class="mt-1 text-xl font-semibold">{{ $asset->model ?? '—' }}</h1>
              
              <div class="mt-2 flex flex-wrap gap-2">
                <span class="px-2.5 py-1 rounded-full bg-gray-100 text-xs font-medium text-gray-700">
                  {{ Str::title(str_replace('_', ' ', $type)) }}
                </span>
                <span class="px-2.5 py-1 rounded-full bg-green-50 text-xs font-medium text-green-700">
                  {{ $status }}
                </span>
              </div>
            </div>

            <div>
                {{-- <a href="/asset/update/{{ $asset->id }}" class="mr-2 text-end rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Edit Asset
                </a> --}}
                
                {{-- @if(!$assignment)
                    <a href="{{ url('/pc-assignments/create?asset_id='.$asset->id) }}"
                        class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                        Assign Now
                    </a>
                @else
                    <a href="{{ url('/pc-assignments/'.$assignment->id) }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        View Assignment
                    </a>
                @endif --}}
            </div>
          </div>
        </div>

        <!-- Body -->
        <div class="p-5 space-y-6">
          
          <!-- Asset Details -->
          <div>
            <h2 class="text-sm font-semibold text-gray-900 mb-3">Basic Details</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
              <div class="border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500">Serial Number</p>
                <p class="mt-1 text-sm font-medium text-gray-900">{{ $serial }}</p>
              </div>

              <div class="border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500">Brand</p>
                <p class="mt-1 text-sm font-medium text-gray-900">{{ $asset->brand ?? '—' }}</p>
              </div>

              <div class="border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500">Model</p>
                <p class="mt-1 text-sm font-medium text-gray-900"> {{ $asset->model ?? '—' }}</p>
              </div>

              <div class="border border-gray-200 rounded-xl px-4 py-3">
                <p class="text-xs text-gray-500">Specs</p>
                <p class="mt-1 text-sm font-medium text-gray-900">
                    @if ($type === 'system_unit' || $type === 'laptop')
                        CPU: {{ $cpu ?? '—' }}<br>
                        RAM: {{ $ram ?? '—' }}<br>
                        Storage: {{ $storage ?? '—' }}<br>
                        Graphics: {{ $graphics ?? '—' }}
                    @elseif ($type === 'monitor')
                        Size: {{ $monitorSize ?? '—' }}<br>
                    @else
                        N/A
                    @endif
                </p>
              </div>
            </div>
          </div>

          <!-- Assignment -->
          {{-- <div>
            <h2 class="text-sm font-semibold text-gray-900 mb-3">Current Pairing</h2>
            <div class="border border-gray-200 rounded-xl divide-y divide-gray-200">
              <div class="flex items-start justify-between gap-4 px-4 py-3">
                <div>
                  <p class="text-xs text-gray-500">Assigned To</p>
                  <p class="mt-1 text-sm font-medium text-gray-900">Juan Dela Cruz</p>
                </div>
                <div class="text-right">
                  <p class="text-xs text-gray-500">Department</p>
                  <p class="mt-1 text-sm font-medium text-gray-900">IT Office</p>
                </div>
              </div>

              <div class="flex items-start justify-between gap-4 px-4 py-3">
                <div>
                  <p class="text-xs text-gray-500">Campus</p>
                  <p class="mt-1 text-sm font-medium text-gray-900">Main Campus</p>
                </div>
                <div class="text-right">
                  <p class="text-xs text-gray-500">Assigned Date</p>
                  <p class="mt-1 text-sm font-medium text-gray-900">March 7, 2026</p>
                </div>
              </div>

              <div class="px-4 py-3">
                <p class="text-xs text-gray-500">Paired Monitor</p>
                <div class="mt-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                  <div>
                    <p class="text-sm font-medium text-gray-900">Dell E201</p>
                    <p class="text-sm text-gray-500">SN: MN-2026-00087</p>
                  </div>

                  <a href="#" class="inline-flex items-center text-sm font-medium text-gray-900 hover:text-gray-600">
                    View paired asset
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 6l6 6-6 6" />
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div> --}}

          <!-- Footer Actions -->
          <div class="flex flex-col-reverse gap-3 pt-2 sm:flex-row sm:justify-between">
            @if ($assignment)
                <a href="/assigned-pc/{{ $assignment->id }}" class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">
                    View Full Assignment
                </a>
            @endif
          </div>
        </div>
      </div>
    </main>
  </div>
</x-layouts.solo-layout>