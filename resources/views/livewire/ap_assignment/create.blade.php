<?php

use App\Models\Asset;
use App\Models\Department;
use Livewire\Volt\Component;
use App\Models\AccessPointAssignment;

new class extends Component {

    public $asset_tag;
    public $ap;
    public $department;

    public function submit()
    {
        $this->validate([
            'asset_tag' => 'required|string|max:255|unique:access_point_assignments,asset_tag',
            'ap' => 'required|unique:access_point_assignments,asset_id',
            'department' => 'nullable',
        ]);

        Asset::where('id', $this->ap)
            ->update(['status' => 'assigned']);

        AccessPointAssignment::create([
            'asset_tag' => $this->asset_tag,
            'asset_id' => $this->ap,
            'department_id' => $this->department,
        ]);
    

        // $this->reset(['name']);

        redirect('assigned-ap')->with('success', 'Access point assigned successfully!');
    }

    public function getAccessPoints()
    {
        return Asset::where('status', 'available')
            ->where('asset_type','access_point')
            ->get();
    }

    public function getDepartment(){
        return Department::get();
    }

    public function with(){
        return [
            'aps' => $this->getAccessPoints(),
            'departments' => $this->getDepartment(),
        ];
    }
    
}; ?>


<div @click.away="fmodal === ''" class="max-w-md mx-auto mt-10 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Assign AP</h2>
    <p class="text-sm text-gray-500 mb-6">Enter the access point to add it to the system.</p>
    <form class="space-y-2" wire:submit.prevent="submit" @click.away="fmodal = ''">
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="name">Asset Tag</label>
            <input
                wire:model="asset_tag"
                type="text"
                id="name"
                name="asset_tag"
                placeholder="e.g. BSP-LOBBY"
                class="uppercase-input w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('name') border-red-500 @enderror"
            >
            <x-input-error :messages="$errors->get('asset_tag')" class="mt-2" />
        </div>
        <label class="block text-sm text-gray-600" for="name">Access Point</label>
        <select wire:model="ap" class="uppercase-input w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('campus') border-red-500 @enderror">
            <option value="">Select AP</option>
            @forelse ($aps as $ap)
                <option value="{{ $ap->id }}">{{ $ap->serial_number . ' | '. $ap->brand . ' | ' . $ap->model }}</option>
            @empty
                <option value="" disabled>No AP available.</option>
            @endforelse
        </select>
        <x-input-error :messages="$errors->get('ap')" class="mt-2" />
        <label class="block text-sm text-gray-600" for="name">Department</label>
        <select wire:model="department" class="uppercase-input w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('campus') border-red-500 @enderror">
            <option value="">Select AP</option>
            @forelse ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @empty
                <option value="" disabled>No AP available.</option>
            @endforelse
        </select>
        <x-input-error :messages="$errors->get('department')" class="mt-2" />
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