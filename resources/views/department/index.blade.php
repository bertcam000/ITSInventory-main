<x-layouts.layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{form: false, fmodal: ''}">
        <button @click="form = true" class="mb-5 px-3 py-2 rounded-md bg-black text-white">Add Department</button>
        <div>
            <x-tables.department_table :departments="$departments" />
        </div>

        <div x-show="form" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 fixed top-0 left-0 z-50  justify-center items-center">
            <div @click.away="form = false" class=" rounded-lg">
                <livewire:department.create/>
            </div>
        </div>
    </div>
</x-layouts.layout>