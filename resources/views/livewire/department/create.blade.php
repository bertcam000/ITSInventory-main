<?php

use Livewire\Volt\Component;

new class extends Component {

    public $name;
    public $campus;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'campus' => 'required',
        ]);

        \App\Models\Department::create([
            'name' => $this->name,
            'campus_id' => $this->campus,
        ]);

        $this->reset(['name']);

        redirect('department')->with('success', 'Department added successfully!');
    }

    public function getCampus(){
        return \App\Models\Campus::get();
    }

    public function with(){
        return [
            'campuses' => $this->getCampus(),
        ];
    }
    
}; ?>


<div @click.away="fmodal === ''" class="max-w-md mx-auto mt-10 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Add New Department</h2>
    <p class="text-sm text-gray-500 mb-6">Enter the department name to add it to the system.</p>
    <form class="space-y-4" wire:submit.prevent="submit" @click.away="fmodal = ''">
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="name">Department Name</label>
            <input
                wire:model="name"
                type="text"
                id="name"
                name="name"
                placeholder="e.g. IT Department"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('name') border-red-500 @enderror"
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <select wire:model="campus" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('campus') border-red-500 @enderror">
            <option value="">Select Campus</option>
            @forelse ($campuses as $campus)
                <option value="available">{{ $campus->name }}</option>
            @empty
                
            @endforelse
        </select>
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-5 py-2 text-sm font-medium bg-gray-900 text-white bg-black rounded-lg hover:bg-gray-800 transition"
            >
                Add Department
            </button>
        </div>

    </form>

</div>

