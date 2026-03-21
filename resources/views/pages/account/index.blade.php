<x-layouts.its_layout>
<div class="min-h-screen">

    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    @if (session('error'))
        <x-notification :message="session('error')" type="error" />
    @endif
    
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">User Account Management</h1>
                <p class="text-sm text-slate-500">Create and view user accounts.</p>
            </div>

            <div class="flex items-center gap-2 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                <div class="h-10 w-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                    {{ count($users) }}
                </div>
                <div>
                    <p class="text-xs text-slate-400">Total Accounts</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

            <!-- FORM -->
            <section class="xl:col-span-5 rounded-lg ">
                <div class="rounded-3xl bg-white border border-gray-400/60 overflow-hidden shadow-sm ring-1 ring-slate-200">
                    <div class=" px-6 py-6 text-black">
                        <h2 class="text-xl font-semibold">Create User</h2>
                    </div>
                    <livewire:account.create/>
                </div>
            </section>

            <!-- USER LIST -->
            <section class="xl:col-span-7">
                <div class="rounded-3xl bg-white border border-gray-400/60 shadow-sm ring-1 ring-slate-200">
                    <form action="/accounts" method="GET" class="px-6 py-5 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold">Accounts</h2>
                         <div class="flex items-center gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" class="w-full rounded border-gray-300" placeholder="Search username">
                            <button class="bg-primary py-2 px-3 text-white rounded">Search</button>
                        </div>
                    </form>

                    <div class="p-6 space-y-4">

                        <!-- USER CARD -->
                        @forelse ($users as $user)
                            
                        
                        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-green-100 flex items-center justify-center rounded-xl font-bold text-green-700">{{ $firstLetter = strtoupper(substr($user->name, 0, 1)); }}</div>
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    <p class="text-sm text-slate-500">{{ $user->role }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2" x-data="{ dl: false }">
                                <button class="bg-yellow-100 px-3 py-1 rounded">Edit</button>
                                <button @click="dl = true" class="bg-red-100 text-black font-semibold px-3 py-1 rounded">Delete</button>
                                {{--  --}}
                                <div x-show="dl" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
                                    <div class="fixed inset-0 bg-black bg-opacity-50" @click="dl = false"></div>

                                    <div class="bg-white rounded-lg shadow-lg w-96 p-6 z-50"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-90"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-90">

                                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Delete Confirmation</h2>
                                        <p class="text-gray-600 mb-6">Are you sure? This account will permanently deleted</p>

                                        <div class="flex justify-end gap-3">
                                            <button @click="dl = false" 
                                                    class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">
                                                Cancel
                                            </button>

                                            <form method="POST" action="/user/delete/{{ $user->id }}">
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
                                {{--  --}}
                            </div>
                        </div>
                        @empty
                            
                        @endforelse

                        <div>
                            {{ $users->links() }}
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

</x-layouts.its_layout>