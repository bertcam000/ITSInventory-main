<?php

use Livewire\Volt\Component;

new class extends Component {

    public $name;
    public $location;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        \App\Models\Campus::create([
            'name' => $this->name,
            'location' => $this->location,
        ]);

        $this->reset(['name']);

        redirect('campus')->with('success', 'Department added successfully!');
    }
    
}; ?>


<div @click.away="fmodal === ''" class="max-w-md mx-auto mt-10 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Add New Campus</h2>
    <p class="text-sm text-gray-500 mb-6">Enter the campus name to add it to the system.</p>
    <form class="space-y-4" wire:submit.prevent="submit" @click.away="fmodal = ''">
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="name">Campus Name</label>
            <input
                wire:model="name"
                type="text"
                id="name"
                name="name"
                placeholder="e.g. IT Department"
                class="uppercase-input w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('name') border-red-500 @enderror"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="name">Location</label>
            <input
                wire:model="location"
                type="text"
                id="location"
                name="location"
                placeholder="e.g. IT Department"
                class="uppercase-input w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('location') border-red-500 @enderror"
            >
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-5 py-2 text-sm font-medium bg-gray-900 text-white bg-black rounded-lg hover:bg-gray-800 transition"
            >
                Add Campus
            </button>
        </div>

    </form>

</div>

