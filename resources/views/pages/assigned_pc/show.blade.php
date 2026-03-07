<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        display: flex;
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

  <div class="min-h-screen bg-gray-50">

    <!-- TOP BAR -->
    <div class="border-b bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

          <div>
            <p class="text-xs text-gray-500">Asset Details</p>

            <h1 class="mt-1 text-lg font-semibold text-gray-900">
              {{ $pcAssignment->asset_id }}
              <span class="ml-2 text-sm text-gray-500">•</span>
              <span class="ml-2 text-sm text-gray-600">{{ $pcAssignment->assigned_to }}</span>
            </h1>
          </div>

          <div class="flex flex-wrap gap-2">
            <button class="rounded-lg border px-3 py-2 text-sm bg-white hover:bg-gray-50">
              Back
            </button>

            <button class="rounded-lg border px-3 py-2 text-sm bg-white hover:bg-gray-50">
              Edit
            </button>

            <button
              onclick="window.print()"
              class="rounded-lg border px-3 py-2 text-sm bg-white hover:bg-gray-50"
            >
              Print QR
            </button>
          </div>

        </div>
      </div>
    </div>


    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-8 space-y-6">

          


          <!-- ASSIGNMENT CARD -->
          <div class="rounded-2xl border bg-white shadow-sm">
            <div class="p-6">

              <h2 class="text-sm font-semibold">Assignment</h2>
              <p class="text-sm text-gray-500">
                Where this asset is deployed.
              </p>


              <div class="mt-6 bg-emerald-50 border border-emerald-100 p-5 rounded-2xl">

                <p class="text-sm font-semibold">Assigned</p>

                <p class="text-sm text-gray-700 mt-1">
                  This PC is assigned to
                  <span class="font-semibold">{{ $pcAssignment->assigned_to }}</span>
                  ({{ $pcAssignment->department->name }} - {{ $pcAssignment->department->campus->name }})
                </p>


                <div class="mt-4 grid grid-cols-2 gap-3">

                  <div class="bg-white border p-4 rounded-xl">
                    <p class="text-xs text-gray-500">System Unit</p>
                    <p class="text-sm font-semibold">{{ $pcAssignment->systemUnit->serial_number }}</p>
                  </div>

                  <div class="bg-white border p-4 rounded-xl">
                    <p class="text-xs text-gray-500">Monitor</p>
                    <p class="text-sm font-semibold">{{ $pcAssignment->monitor->serial_number }}</p>
                  </div>

                </div>

              </div>

            </div>
          </div>

          <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- System Unit Specs -->
            <div class="bg-white border rounded-2xl shadow-sm p-6">
              
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-900">System Unit Specs</h3>
                <span class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                  PC
                </span>
              </div>

              <div class="space-y-3 text-sm">

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Brand</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->brand }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Model</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->model }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">CPU</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->systemUnitSpec->processor }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">RAM</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->systemUnitSpec->memory }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Storage</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->systemUnitSpec->storage }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Graphics</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->systemUnit->systemUnitSpec->videocard }}</span>
                </div>

              </div>

            </div>


            <!-- Monitor Specs -->
            <div class="bg-white border rounded-2xl shadow-sm p-6">

              <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-900">Monitor Specs</h3>
                <span class="text-xs bg-purple-50 text-purple-700 px-2 py-1 rounded-full">
                  Display
                </span>
              </div>

              <div class="space-y-3 text-sm">

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Brand</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->monitor->brand }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Model</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->monitor->model }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                  <span class="text-gray-500">Size</span>
                  <span class="font-medium text-gray-900">{{ $pcAssignment->monitor->monitorSpec->size }}</span>
                </div>

              </div>

            </div>

          </div>

        </div>


        <!-- RIGHT COLUMN -->
        <aside class="lg:col-span-4 space-y-6">

          <!-- QR CARD -->
          <div class="rounded-2xl border bg-white shadow-sm">
            <div id="qr-print-area" class="flex justify-center items-center flex-col gap-5 p-6">
                <div class="flex justify-center items-center gap-2">
                  <div class="text-center">
                    <p class="text-xs text-gray-500">SystemUnit</p>
                    <p>{{ $pcAssignment->systemUnit->serial_number }}</p>
                  </div>
                  <div class="text-center">
                    <p class="text-xs text-gray-500">Monitor</p>
                    <p>{{ $pcAssignment->monitor->serial_number }}</p>
                  </div>
                </div>
                
                <div class="">
                  {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(180)->margin(0)->generate(url('/assigned-pc/'.$pcAssignment->id)) !!}
                </div>
                
            </div>
          </div>


          <!-- SUMMARY -->
          <div class="rounded-2xl border bg-white shadow-sm">
            <div class="p-6">

              <h2 class="text-sm font-semibold">Quick Summary</h2>

              <div class="mt-5 space-y-3">

                <div class="flex justify-between bg-gray-50 p-4 rounded-xl">
                  <p class="text-sm text-gray-600">Status</p>
                  <p class="text-sm font-semibold">{{ $pcAssignment->status }}</p>
                </div>

                <div class="flex justify-between bg-gray-50 p-4 rounded-xl">
                  <p class="text-sm text-gray-600">Assigned To</p>
                  <p class="text-sm font-semibold">{{ $pcAssignment->assigned_to }}</p>
                </div>

                <div class="flex justify-between bg-gray-50 p-4 rounded-xl">
                  <p class="text-sm text-gray-600">Department</p>
                  <p class="text-sm font-semibold">{{ $pcAssignment->department->name  }}</p>
                </div>

                <div class="flex justify-between bg-gray-50 p-4 rounded-xl">
                  <p class="text-sm text-gray-600">Campus</p>
                  <p class="text-sm font-semibold">{{ $pcAssignment->department->campus->name }}</p>
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