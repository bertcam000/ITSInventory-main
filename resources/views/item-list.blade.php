<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="h-full">

    <div class="">
        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
    </div>

    <div class="bg-green-500 flex justify-center items-center" x-data="{form: false, fmodal: ''}">
        <div>
            <button @click="form = true" class="">Create Item</button>
        </div>
        
        <div x-show="form" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <div @click.away="form = false" class="bg-white text-center p-5 space-y-4 rounded-lg">
                <div class="text-xl">Choose</div>
                <div class="flex items-center gap-5">
                    <button @click="fmodal = 'su' ; form = false">System Unit</button>
                    <button>Monitor</button>
                </div>
            </div>
        </div>
        
        {{-- form --}}

        <div x-show="fmodal === 'su'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <div @click.away="fmodal === ''" class="bg-white text-center p-5 space-y-4 rounded-lg">
                <div class="text-xl">Add System Unit</div>
                <div class="flex items-center gap-5">
                    <x-su-form/>
                </div>
            </div>
        </div>

    </div>
    @livewireScripts
</body>
</html>