<?php

use Livewire\Volt\Component;
use App\Models\Department;
use App\Models\Asset;
use App\Models\Campus;
use App\Models\PcAssignment;

new class extends Component {

    /* =======================
     |  FORM PROPERTIES
     ======================= */
    public $asset_id = null;
    public $campus = null;
    public $department = null;
    public $systemUnit = null;
    public $monitor = null;
    public $assignedTo = '';
    // public $status = null;

    /* =======================
     |  VALIDATION
     ======================= */
    protected $rules = [
        'asset_id' => 'required|string|unique:pc_assignments,asset_id',
        'campus' => 'required|exists:campuses,id',
        'department' => 'required|exists:departments,id',
        'systemUnit' => 'required|exists:assets,id',
        'monitor' => 'required|exists:assets,id',
        'assignedTo' => 'required|string|max:255',
        // 'status' => 'required|in:assigned,unassigned',
    ];

    /* =======================
     |  ACTIONS
     ======================= */
    public function submit()
    {
        $this->validate();

        PcAssignment::create([
            'asset_id' => $this->asset_id,
            'department_id' => $this->department,
            'system_unit_id' => $this->systemUnit,
            'monitor_id' => $this->monitor,
            'assigned_to' => $this->assignedTo,
            
        ]);

        Asset::whereIn('id', [$this->systemUnit, $this->monitor])
            ->update(['status' => 'assigned']);

        return redirect('assigned-pc')
            ->with('success', 'Unit Assigned Successfully');
    }

    /* =======================
     |  COMPUTED PROPERTIES
     ======================= */

    // All campuses
    public function getCampusesProperty()
    {
        return Campus::orderBy('name')->get();
    }

    // Departments based on selected campus
    public function getDepartmentsProperty()
    {
        if (!$this->campus) {
            return collect();
        }

        return Department::where('campus_id', $this->campus)
            ->get();
    }

    // Available assets
    public function getSystemUnitsProperty()
    {
        return Asset::where('status', 'available')
            ->where('asset_type', 'system_unit')
            ->with('systemUnitSpec')
            ->get();
    }

    public function getMonitorsProperty()
    {
        return Asset::where('status', 'available')
            ->where('asset_type', 'monitor')
            ->with('monitorSpec')
            ->get();
    }

    /* =======================
     |  HOOKS
     ======================= */
    public function updatedCampus()
    {
        // Reset department when campus changes
        $this->department = null;
    }

};
?>

<div class="max-w-3xl mx-auto  bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

    <h2 class="text-xl font-semibold text-gray-800 mb-2">Assign PC</h2>
    <p class="text-sm text-gray-500 mb-6">
        Select a campus, then assign a system unit and monitor to a department. {{ $campus }}
    </p>

    <form class="space-y-4" wire:submit.prevent="submit">


        <div>
            <label class="block text-sm text-gray-600 mb-1">Asset ID</label>
            <input type="text"
                   wire:model="asset_id"
                   class="w-full border rounded-lg px-4 py-2"
                   placeholder="e.g. SPS-001">
            <x-input-error :messages="$errors->get('asset_id')" class="mt-2" />
        </div>
        
        <!-- CAMPUS -->
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Campus</label>
                <select wire:model.live="campus"
                        class="w-full border rounded-lg px-4 py-2">
                    <option value="">Select Campus</option>
                    @forelse ($this->campuses as $cam)
                        <option value="{{ $cam->id }}">{{ $cam->name }}</option>
                    @empty
                        <option value="" disabled>No data found.</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('campus')" class="mt-2" />
            </div>

            <!-- DEPARTMENT -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Department</label>
                <select wire:model="department"
                        class="w-full border rounded-lg px-4 py-2"
                        @disabled(!$campus)>
                    <option value="">
                        {{ $campus ? 'Select Department' : 'Select Campus First' }}
                    </option>

                    @forelse ($this->getDepartmentsProperty() as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @empty
                        <option value="" disabled>No data found.</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('department')" class="mt-2" />
            </div>
        </div>

        <!-- SYSTEM UNIT -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">System Unit</label>
            <select wire:model="systemUnit"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="">Select System Unit</option>
                @forelse ($this->systemUnits as $unit)
                    <option value="{{ $unit->id }}">
                        {{ $unit->serial_number }} |
                        {{ $unit->brand }} |
                        {{ $unit->model }} |
                        {{ $unit->systemUnitSpec->memory }} |
                        {{ $unit->systemUnitSpec->storage }}
                    </option>
                @empty
                    <option value="" disabled>No data found.</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('systemUnit')" class="mt-2" />
        </div>

        <!-- MONITOR -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Monitor</label>
            <select wire:model="monitor"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="">Select Monitor</option>
                @forelse ($this->monitors as $monitor)
                    <option value="{{ $monitor->id }}">
                        {{ $monitor->serial_number }} |
                        {{ $monitor->brand }} |
                        {{ $monitor->model }} |
                        {{ $monitor->monitorSpec->size }}
                    </option>
                @empty
                    <option value="" disabled>No data found.</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('monitor')" class="mt-2" />
        </div>

        <!-- ASSIGNED TO -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Assigned To</label>
            <input type="text"
                   wire:model="assignedTo"
                   class="w-full border rounded-lg px-4 py-2"
                   placeholder="e.g. Juan Dela Cruz">
            <x-input-error :messages="$errors->get('assignedTo')" class="mt-2" />
        </div>

        <!-- STATUS -->
        {{-- <div>
            <label class="block text-sm text-gray-600 mb-1">Status</label>
            <select wire:model="status"
                    class="w-full border rounded-lg px-4 py-2">
                <option value="">Select Status</option>
                <option value="assigned">Assigned</option>
                <option value="unassigned">Unassigned</option>
            </select>
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
        </div> --}}

        <!-- SUBMIT -->
        <div class="flex justify-end mt-6">
            <button type="submit"
                    class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                Assign PC
            </button>
        </div>

    </form>
</div>
