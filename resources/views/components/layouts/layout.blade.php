<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Document</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="overflow-x-hidden">
    <div class="min-h-screen bg-slate-200 flex flex-col" x-data="{ sidebarOpen: false }">

        {{-- NAVBAR --}}
        

        {{-- CONTENT WRAPPER --}}
        <div class="flex flex-1 min-w-0">

            {{-- SIDEBAR --}}
            <aside
                class="w-56 bg-white shadow-lg shrink-0 hidden lg:block border-r border-gray-300/50"
                :class="{ 'fixed inset-y-0 left-0 z-50 block': sidebarOpen, 'hidden': !sidebarOpen }"
                x-cloak
            >
                <div class="p-6 text-xl font-bold border-b border-blue-700 relative">
                    <button @click="sidebarOpen = false" class="absolute right-2 top-1 block lg:hidden">x</button>
                    Dashboard
                </div>

                <ul class="space-y-3 p-4 ">
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md"><a href="#">Dashboard</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md {{ request()->is('inventory') ? 'bg-blue-300 text-white' : '' }}"><a href="/inventory">Inventory</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md {{ request()->is('assigned-pc') ? 'bg-blue-300 text-white' : '' }}"><a href="/assigned-pc">PC Assignment</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md {{ request()->is('department') ? 'bg-blue-300 text-white' : '' }}"><a href="/department">Department</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md"><a href="#">QR Scanner</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md"><a href="#">Users</a></li>
                    <li class="hover:bg-blue-300 hover:text-white px-3 py-2 rounded-md"><a href="#">Settings</a></li>
                </ul>
            </aside>

            {{-- MAIN CONTENT --}}
            <main class="flex-1  overflow-x-hidden ">
                <nav class="flex justify-between items-center bg-white shadow-sm py-3 px-6 shrink-0 sticky top-0 left-0 right-0">
                    <button class="block lg:hidden" @click="sidebarOpen = !sidebarOpen">button</button>
                    <h3 class="font-bold">ITS Inventory Management</h3>
                    <div class="flex items-center gap-4">
                        <p>Admin</p>
                        <img src="https://i.pravatar.cc/40" alt="" class="w-9 h-9 rounded-full">
                    </div>
                </nav>
                <div class="bg-white p-6 m-6 rounded shadow-lg max-w-full overflow-x-auto">
                    {{ $slot }}
                </div>
            </main>

        </div>
    </div>

    @livewireScripts
</body>
</html>
