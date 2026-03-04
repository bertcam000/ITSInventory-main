<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Asset Details</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
  @media print {
      body * {
          visibility: hidden;
      }

      #qr-print-area,
      #qr-print-area * {
          visibility: visible;
      }

      #qr-print-area {
          position: absolute;
          display:flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          left: 0;
          top: 0;
          width: 100%;
          text-align: center;
      }
  }
</style>
  
</head>

<body class="bg-slate-100 min-h-screen font-sans text-slate-800">

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

<div class="min-h-screen bg-gray-50">
  <!-- Top bar -->
  <div class="border-b bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="min-w-0">
          <p class="text-xs font-medium text-gray-500">Asset Details</p>
          <h1 class="mt-1 text-lg sm:text-xl font-semibold text-gray-900 truncate">
            {{ $assetTitle }}
            <span class="ml-2 text-sm font-medium text-gray-500">•</span>
            <span class="ml-2 text-sm font-medium text-gray-600">SN: {{ $serial }}</span>
          </h1>
        </div>

        <div class="flex flex-wrap gap-2">
          <a href="{{ url()->previous() }}"
             class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Back
          </a>

          @if(!$assignment)
            <a href="{{ url('/pc-assignments/create?asset_id='.$asset->id) }}"
               class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700">
              Assign Asset
            </a>
          @endif

          <a href="{{ url('/inventory/'.$asset->id.'/edit') }}"
             class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Edit
          </a>

          <button onclick="window.print()"
            class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            Print QR
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      <!-- Left column -->
      <div class="lg:col-span-8 space-y-6">
        <!-- Asset info card -->
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
          <div class="p-5 sm:p-6">
            <div class="flex items-start justify-between gap-4">
              <div>
                <h2 class="text-sm font-semibold text-gray-900">Asset Information</h2>
                <p class="mt-1 text-sm text-gray-500">Core details for this item.</p>
              </div>

              <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset
                {{ $status === 'available' ? 'bg-emerald-50 text-emerald-700 ring-emerald-200' : 'bg-gray-50 text-gray-700 ring-gray-200' }}">
                {{ $status }}
              </span>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Item Type</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $type }}</p>
              </div>

              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Serial Number</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $serial }}</p>
              </div>

              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Brand</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $asset->brand ?? '—' }}</p>
              </div>

              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Model</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $asset->model ?? '—' }}</p>
              </div>
            </div>

            <div class="mt-4 rounded-xl border border-gray-100 bg-gray-50 p-4">
              <p class="text-xs font-medium text-gray-500">Specs</p>

              @if($spec)
                <div class="mt-2 text-sm text-gray-900 space-y-1">
                  @if($cpu) <p><span class="font-semibold">CPU:</span> {{ $cpu }}</p> @endif
                  @if($ram) <p><span class="font-semibold">RAM:</span> {{ $ram }}</p> @endif
                  @if($storage) <p><span class="font-semibold">Storage:</span> {{ $storage }}</p> @endif
                  @if($graphics) <p><span class="font-semibold">Graphics:</span> {{ $graphics }}</p> @endif

                  @if($monitorSize) <p><span class="font-semibold">Size:</span> {{ $monitorSize }}</p> @endif
                  @if($resolution) <p><span class="font-semibold">Resolution:</span> {{ $resolution }}</p> @endif

                  @if(!$cpu && !$ram && !$storage && !$graphics && !$monitorSize && !$resolution)
                    <p class="text-gray-500">No spec details available.</p>
                  @endif
                </div>
              @else
                <p class="mt-2 text-sm text-gray-500">No specs available for this asset type.</p>
              @endif
            </div>

            <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Campus</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $campusName }}</p>
              </div>
              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Location</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $asset->location ?? '—' }}</p>
              </div>
              <div class="rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-xs font-medium text-gray-500">Added On</p>
                <p class="mt-1 text-sm font-semibold text-gray-900">{{ $createdAt }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Assignment card -->
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
          <div class="p-5 sm:p-6">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
              <div>
                <h2 class="text-sm font-semibold text-gray-900">Assignment</h2>
                <p class="mt-1 text-sm text-gray-500">Where this asset is currently deployed.</p>
              </div>

              @if(!$assignment)
                <a href="{{ url('/pc-assignments/create?asset_id='.$asset->id) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-2 text-sm font-medium text-white hover:bg-emerald-700">
                  Assign Now
                </a>
              @else
                <a href="{{ url('/pc-assignments/'.$assignment->id) }}"
                   class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                  View Assignment
                </a>
              @endif
            </div>

            @if(!$assignment)
              <!-- UNASSIGNED STATE -->
              <div class="mt-6 rounded-2xl border border-gray-100 bg-gray-50 p-5">
                <div class="flex items-start gap-3">
                  <div class="mt-0.5 h-9 w-9 rounded-xl bg-white border border-gray-200 flex items-center justify-center">
                    <span class="text-lg">⚪</span>
                  </div>
                  <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900">Not Assigned</p>
                    <p class="mt-1 text-sm text-gray-600">
                      This asset is currently available and not connected to any department or PC assignment.
                    </p>

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                      <div class="rounded-xl border border-gray-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">Department</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">—</p>
                      </div>
                      <div class="rounded-xl border border-gray-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">Paired Monitor</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">—</p>
                      </div>
                      <div class="rounded-xl border border-gray-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">Assigned Date</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">—</p>
                      </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                      <a href="{{ url('/pc-assignments/create?asset_id='.$asset->id) }}"
                         class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-black">
                        Create Assignment
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @else
              <!-- ASSIGNED STATE -->
              <div class="mt-6 rounded-2xl border border-emerald-100 bg-emerald-50 p-5">
                <div class="flex items-start gap-3">
                  <div class="mt-0.5 h-9 w-9 rounded-xl bg-white border border-emerald-200 flex items-center justify-center">
                    <span class="text-lg">🟢</span>
                  </div>

                  <div class="min-w-0 w-full">
                    <p class="text-sm font-semibold text-gray-900">Assigned</p>
                    <p class="mt-1 text-sm text-gray-700">
                      This asset is part of a PC set assigned to <span class="font-semibold">{{ $deptName }}</span>
                      <span class="text-gray-500">({{ $campusName }})</span>.
                    </p>

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                      <div class="rounded-xl border border-emerald-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">Department</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">{{ $deptName }}</p>
                        <p class="mt-1 text-xs text-gray-500">{{ $campusName }}</p>
                      </div>

                      <div class="rounded-xl border border-emerald-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">System Unit</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">{{ $suSerial }}</p>
                        <p class="mt-1 text-xs text-gray-500">{{ $suName }}</p>
                      </div>

                      <div class="rounded-xl border border-emerald-100 bg-white p-4">
                        <p class="text-xs font-medium text-gray-500">Monitor</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">{{ $monSerial }}</p>
                        <p class="mt-1 text-xs text-gray-500">{{ $monName }}</p>
                      </div>
                    </div>

                    <div class="mt-4 flex flex-wrap gap-2">
                      <a href="{{ url('/pc-assignments/'.$assignment->id) }}"
                         class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white hover:bg-black">
                        Open Assignment
                      </a>

                      <a href="{{ url('/pc-assignments/'.$assignment->id.'/edit') }}"
                         class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Change Assignment
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            <p class="mt-4 text-xs text-gray-500">
              Tip: This updates based on the latest PC assignment record for this asset.
            </p>
          </div>
        </div>
      </div>

      <!-- Right column -->
      <aside class="lg:col-span-4 space-y-6">
        <!-- QR Card -->
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
          <div class="p-5 sm:p-6">
            

            <div class="pc-details rounded-2xl border border-gray-100 bg-gray-50 p-5 flex flex-col items-center justify-center">
              <div id="qr-print-area">
                <div class="flex justify-center items-center gap-2">
                  <div class="text-center">
                    <p class="text-xs text-gray-500">SystemUnit</p>
                    <p>{{ $suSerial }}</p>
                  </div>
                  <div class="text-center">
                    <p class="text-xs text-gray-500">Monitor</p>
                    <p>{{ $monSerial }}</p>
                  </div>
                </div>
                <div>
                  {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->margin(0)->generate($qrUrl) !!}
                </div>
              </div>
            </div>

            
          </div>
        </div>

        <!-- Quick Summary -->
        <div class="rounded-2xl border border-gray-200 bg-white shadow-sm">
          <div class="p-5 sm:p-6">
            <h2 class="text-sm font-semibold text-gray-900">Quick Summary</h2>
            <div class="mt-5 space-y-3">
              <div class="flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm text-gray-600">Status</p>
                <span class="text-sm font-semibold text-gray-900">{{ $status }}</span>
              </div>
              <div class="flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm text-gray-600">Assignment</p>
                <span class="text-sm font-semibold text-gray-900">{{ $assignment ? 'Assigned' : 'Not Assigned' }}</span>
              </div>
              <div class="flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm text-gray-600">Department</p>
                <span class="text-sm font-semibold text-gray-900">{{ $assignment ? $deptName : '—' }}</span>
              </div>
              <div class="flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 p-4">
                <p class="text-sm text-gray-600">Campus</p>
                <span class="text-sm font-semibold text-gray-900">{{ $assignment ? $campusName : '—' }}</span>
              </div>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
</div>


</body>
</html>
