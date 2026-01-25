<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>System Unit QR Code</title>
   @vite('resources/css/app.css')
   @livewireStyles
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
   <div class="bg-white flex flex-col justify-center items-center rounded-xl shadow-lg p-8 text-center space-y-6 w-full max-w-md">
        <h1 class="text-2xl font-bold">System Unit QR Code</h1>

        <div class="text-left space-y-2">
        <p><span class="font-semibold">Serial Number:</span> 1234567890</p>
        <p><span class="font-semibold">Brand:</span> Dell</p>
        <p><span class="font-semibold">Model:</span> Optiplex 3080</p>
        </div>

        <div class="mt-4">
        <!-- QR Code Placeholder -->
        @if(session('qrCode'))
            <p class="mb-1 tracking-widest text-xl font-bold">{{ session('qrCode') }}</p>
            {{-- {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(300)->generate(session('qrCode')) !!} --}}
            {!! session('qrCode') !!}
        @endif
        </div>

        <button onclick="window.print()" class="mt-6 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
        Print QR
        </button>
    </div>
    @livewireScripts
</body>
</html>
