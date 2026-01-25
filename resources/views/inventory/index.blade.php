<x-layouts.layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{form: false, fmodal: ''}">
        <button @click="form = true" class="mb-5 px-3 py-2 rounded-md bg-black text-white">Create New Asset</button>
        <div>
            <x-tables.table :assets="$assets"/>
        </div>

        <div x-show="form" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <div @click.away="form = false" class="bg-white text-center p-5 space-y-4 rounded-lg">
                <div class="text-xl">Choose</div>
                <div class="flex items-center gap-5">
                    <button @click="fmodal = 'su' ; form = false">System Unit</button>
                    <button @click="fmodal = 'monitor' ; form = false">Monitor</button>
                </div>
            </div>
        </div>

        <div x-show="fmodal === 'su'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <livewire:inventory.su-form/>
        </div>
        <div x-show="fmodal === 'monitor'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <livewire:inventory.monitor-form/>
        </div>
        
    </div>
</x-layouts.layout>