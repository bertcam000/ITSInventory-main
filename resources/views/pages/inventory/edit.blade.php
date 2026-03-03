<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Asset</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

@if (session('success'))
    <x-notification :message="session('success')" type="success" />
@endif
<body class="bg-slate-50 text-slate-900">
  <div class="min-h-screen">
    <!-- Top Bar -->
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
              <h1 class="text-lg sm:text-xl font-semibold tracking-tight">Edit Asset</h1>
              <p class="text-xs sm:text-sm text-slate-500">Update asset info, status, and assignments.</p>
            </div>
          </div>

          <div class="hidden sm:flex items-center gap-2">
            <button type="button"
              class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
              Cancel
            </button>
            <button type="submit" form="editAssetForm"
              class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
              Save Changes
              <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Page -->
    <main class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
      <!-- Status strip -->
      <div class="mb-6 grid grid-cols-1 gap-3 sm:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-xs font-medium text-slate-500">Asset ID</p>
          <p class="mt-1 text-sm font-semibold text-slate-900">AST-000123</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-xs font-medium text-slate-500">Current Status</p>
          <div class="mt-2 inline-flex items-center gap-2 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">
            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
            {{ $asset->status }}
          </div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-4">
          <p class="text-xs font-medium text-slate-500">Last Updated</p>
          <p class="mt-1 text-sm font-semibold text-slate-900">{{ $asset->updated_at }}</p>
        </div>
      </div>

      <form id="editAssetForm" action="/asset/update/{{ $asset->id }}" method="POST" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @csrf
        @method('PATCH')
        <!-- Left: Main Form -->
        <section class="lg:col-span-3 space-y-6">
          <!-- Basic Info -->
          <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
              <h2 class="text-sm font-semibold text-slate-900">Basic Information</h2>
              <p class="mt-1 text-xs text-slate-500">Core identifiers and classification.</p>
            </div>

            <div class="p-5 space-y-5">
              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <div>
                  <label class="text-sm font-medium text-slate-700">Serial Number</label>
                  <input name="serial_number" type="text" value="{{ $asset->serial_number }}"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                    placeholder="Unique serial number" />
                </div>
                </div>

                <div>
                  <label class="text-sm font-medium text-slate-700">Status</label>
                  <select name="status"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-200">
                    <option value="available" {{ $asset->status === 'available' ? 'selected' : '' }}>available</option>
                    <option value="assigned" {{ $asset->status === 'assigned' ? 'selected' : '' }}>assigned</option>
                    <option value="repair" {{ $asset->status === 'repair' ? 'selected' : '' }}>repair</option>
                    <option value="retired" {{ $asset->status === 'retired' ? 'selected' : '' }}>retired</option>
                  </select>
                </div>
              </div>

              <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                  <label class="text-sm font-medium text-slate-700">Brand</label>
                  <input type="text" value="{{ $asset->brand }}" name="brand"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                    placeholder="e.g., Dell, HP, Lenovo" />
                </div>

                <div>
                  <label class="text-sm font-medium text-slate-700">Model</label>
                  <input type="text" value="{{ $asset->model }}" name="model"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                    placeholder="e.g., OptiPlex 7090" />
                </div>
              </div>
            </div>
          </div>

          <!-- Specs / Notes -->
          <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-5 py-4">
              <h2 class="text-sm font-semibold text-slate-900">Specifications & Notes</h2>
              <p class="mt-1 text-xs text-slate-500">Store details like CPU/RAM, display size, etc.</p>
            </div>

            <div class="p-5 space-y-4">
                @if ($asset->asset_type === 'system_unit' || $asset->asset_type === 'laptop')
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                        <label class="text-sm font-medium text-slate-700">Processor</label>
                        <input type="text" value="{{ $asset->systemUnitSpec->processor }}" name="processor"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            placeholder="e.g., Intel i7, AMD Ryzen 7" />
                        </div>

                        <div>
                        <label class="text-sm font-medium text-slate-700">Memory</label>
                        <input type="text" value="{{ $asset->systemUnitSpec->memory }}" name="memory"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            placeholder="e.g., 16GB, 32GB" />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                        <label class="text-sm font-medium text-slate-700">Storage</label>
                        <input type="text" value="{{ $asset->systemUnitSpec->storage }}" name="storage"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            placeholder="e.g., 512GB SSD, 1TB HDD" />
                        </div>

                        <div>
                        <label class="text-sm font-medium text-slate-700">Video Card</label>
                        <input type="text" value="{{ $asset->systemUnitSpec->videocard }}" name="videocard"
                            class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            placeholder="e.g., NVIDIA GeForce RTX 3080, AMD Radeon RX 7900 XTX" />
                        </div>
                    </div>
                    
                @elseif ($asset->asset_type === 'monitor')
                    <div>
                        <label class="text-sm font-medium text-slate-700">Monitor Size</label>
                        <textarea rows="1" name="size"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        placeholder="e.g., 24-inch, 1080p, Dell P2419H">{{ $asset->monitorSpec->size ?? '' }}</textarea>
                @endif

              <div>
                <label class="text-sm font-medium text-slate-700">Notes</label>
                <textarea rows="3" name="remarks"
                  class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 shadow-sm outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                  placeholder="Optional notes (condition, repairs, etc.)">{{ $asset->remarks ?? '' }}</textarea>
              </div>
            </div>
          </div>

          <!-- Assignment -->
          
        </section>

        <!-- Right: Sidebar -->
        

        <!-- Mobile Sticky Actions -->
        <div class="sm:hidden fixed bottom-0 left-0 right-0 z-50 border-t border-slate-200 bg-white/90 backdrop-blur">
          <div class="mx-auto max-w-6xl px-4 py-3 flex gap-2">
            <button type="button"
              class="flex-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
              Cancel
            </button>
            <button type="submit"
              class="flex-1 rounded-lg bg-slate-900 px-3 py-2 text-sm font-medium text-white hover:bg-slate-800">
              Save
            </button>
          </div>
        </div>

        <!-- Spacer for mobile sticky bar -->
        <div class="sm:hidden h-16"></div>
      </form>
    </main>
  </div>
</body>
</html>