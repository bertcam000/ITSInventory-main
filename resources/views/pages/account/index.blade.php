<x-layouts.its_layout>
<div class="min-h-screen">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">User Account Management</h1>
                <p class="text-sm text-slate-500">Create and view user accounts.</p>
            </div>

            <div class="flex items-center gap-2 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-200">
                <div class="h-10 w-10 rounded-xl bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                    5
                </div>
                <div>
                    <p class="text-xs text-slate-400">Total Accounts</p>
                    <p class="text-sm font-semibold text-slate-800">Dummy Data</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-12">

            <!-- FORM -->
            <section class="xl:col-span-5 rounded-lg ">
                <div class="rounded-3xl bg-white border border-gray-400/60 overflow-hidden shadow-sm ring-1 ring-slate-200">
                    <div class="bg-primary px-6 py-6 text-white">
                        <h2 class="text-xl font-semibold">Create User</h2>
                    </div>

                    <form class="space-y-5 px-6 py-6">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Full Name</label>
                            <input type="text"
                                wire:model="asset_tag"
                                class="uppercase-input w-full border rounded-lg px-4 py-2"
                                placeholder="e.g. SPS-001">
                            <x-input-error :messages="$errors->get('asset_tag')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Asset ID</label>
                            <input type="text"
                                wire:model="asset_tag"
                                class="uppercase-input w-full border rounded-lg px-4 py-2"
                                placeholder="e.g. SPS-001">
                            <x-input-error :messages="$errors->get('asset_tag')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Asset ID</label>
                            <input type="text"
                                wire:model="asset_tag"
                                class="uppercase-input w-full border rounded-lg px-4 py-2"
                                placeholder="e.g. SPS-001">
                            <x-input-error :messages="$errors->get('asset_tag')" class="mt-2" />
                        </div>


                        <button class="w-full rounded-2xl bg-indigo-600 py-3 text-white font-semibold ">
                            Create Account
                        </button>
                    </form>
                </div>
            </section>

            <!-- USER LIST -->
            <section class="xl:col-span-7">
                <div class="rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="px-6 py-5 border-b">
                        <h2 class="text-lg font-semibold">Accounts</h2>
                    </div>

                    <div class="p-6 space-y-4">

                        <!-- USER CARD -->
                        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-indigo-100 flex items-center justify-center rounded-xl font-bold text-indigo-700">A</div>
                                <div>
                                    <p class="font-semibold">Admin User</p>
                                    <p class="text-sm text-slate-500">@admin</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 px-3 py-1 rounded">Edit</button>
                                <button class="bg-red-100 px-3 py-1 rounded">Delete</button>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-indigo-100 flex items-center justify-center rounded-xl font-bold text-indigo-700">H</div>
                                <div>
                                    <p class="font-semibold">HR Manager</p>
                                    <p class="text-sm text-slate-500">@hrmanager</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 px-3 py-1 rounded">Edit</button>
                                <button class="bg-red-100 px-3 py-1 rounded">Delete</button>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-slate-50 p-4 rounded-2xl">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 bg-indigo-100 flex items-center justify-center rounded-xl font-bold text-indigo-700">S</div>
                                <div>
                                    <p class="font-semibold">Staff User</p>
                                    <p class="text-sm text-slate-500">@staff01</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="bg-yellow-100 px-3 py-1 rounded">Edit</button>
                                <button class="bg-red-100 px-3 py-1 rounded">Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>
</div>

</x-layouts.its_layout>