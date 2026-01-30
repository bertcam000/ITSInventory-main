<?php

use Livewire\Volt\Component;
use App\Models\Department;
use App\Models\Asset;
use App\Models\PcAssignment;

new class extends Component {

    public $department;
    public $systemUnit;
    public $monitor;
    public $assignedTo;
    public $status;

    protected $rules = [
        'department' => 'required',
        'systemUnit' => 'required',
        'assignedTo' => 'required',
        'monitor' => 'required',
        'status' => 'required',
    ];
    
    public function submit(){

        $this->validate();

        // dd($this->department . $this->systemUnit . $this->monitor);
        
        PcAssignment::create([
            'department_id' => $this->department,
            'system_unit_id' => $this->systemUnit,
            'monitor_id' => $this->monitor,
            'assigned_to' => $this->assignedTo,
            'status' => $this->status,
        ]);

        $systemUnit = Asset::findOrFail($this->systemUnit);
        $systemUnit->update(['status' => 'assigned']);

        $monitor = Asset::findOrFail($this->monitor);
        $monitor->update(['status' => 'assigned']);
        
        redirect('assigned-pc')->with('success', 'Unit Assigned Successfully');

        
    }
    
    public function getDepartment(){
        return Department::orderBy('name')->get();
    }

    public function getAssets(){
        return Asset::where('status', 'available')->with('systemUnitSpec')->get();
    }

    public function with(){
        return [
            'departments' => $this->getDepartment(),
            'assets' => $this->getAssets()
        ];
    }
    
}; ?>

<div class="max-w-3xl mx-auto mt-10 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

    <!-- Header -->
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Assign PC</h2>
    <p class="text-sm text-gray-500 mb-6">Fill out the details below to assign a system unit and monitor to a department.</p>

    <!-- Form -->
    <form class="space-y-4" wire:submit.prevent="submit">

        <!-- System Unit -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="system_unit">Departments</label>
            <select id="department" wire:model="department" name="department" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('department') border-red-500 @enderror">
                <option value="">Select Department</option>
                @forelse ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @empty
                    <option disabled value="">No department available.</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <!-- Monitor -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="monitor">System Units</label>
            <select id="systemUnit" wire:model="systemUnit" name="systemUnit" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('systemUnit') border-red-500 @enderror">
            <option value="">Select System Units</option>
            @forelse ($assets as $asset)
                @if ($asset->asset_type === 'system_unit')
                    <option value="{{ $asset->id }}">{{ $asset->serial_number . ' | ' . $asset->brand . ' | ' . $asset->model . ' | ' . $asset->systemUnitSpec->memory . ' | ' . $asset->systemUnitSpec->storage }}</option>
                @endif
            @empty
                <option disabled value="">No system unit available.</option>
            @endforelse
            </select>
            <x-input-error :messages="$errors->get('systemUnit')" class="mt-2" />
        </div>

        <!-- Department -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="monitor">Monitor</label>
            <select id="monitor" wire:model="monitor" name="monitor" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('monitor') border-red-500 @enderror">
                <option value="">Select Monitor</option>
                @forelse ($assets as $asset)
                    @if ($asset->asset_type === 'monitor')
                        <option value="{{ $asset->id }}">{{ $asset->serial_number . ' | ' . $asset->brand . ' | ' . $asset->model . ' | ' . $asset->monitorSpec->size }}</option>
                    @endif
                @empty
                    <option disabled value="">No monitor available.</option>
                @endforelse
                <x-input-error :messages="$errors->get('monitor')" class="mt-2" />
            </select>
        </div>

        <!-- Assigned To -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="assigned_to">Assigned To</label>
            <input
                type="text"
                id="assignedTo"
                wire:model="assignedTo"
                name="assignedTo"
                placeholder="e.g. Juan Dela Cruz"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('assignedTo') border-red-500 @enderror"
                
            >
            <x-input-error :messages="$errors->get('assignedTo')" class="mt-2" />
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="status">Status</label>
            <select
                id="status"
                wire:model="status"
                name="status"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none @error('status') border-red-500 @enderror"
                
            >
                <option value="">Status</option>
                <option value="assigned">Assigned</option>
                <option value="unassigned">Unassigned</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end mt-4">
            <button
                type="submit"
                class="px-6 py-2 text-sm font-medium bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition"
            >
                Assign PC
            </button>
        </div>

    </form>
</div>

