<?php

use Livewire\Volt\Component;
use App\Models\AccessPointAssignment;
use App\Models\Campus;
use App\Models\Location;
use App\Models\Asset;

new class extends Component {

    /* =======================
     | FORM PROPERTIES
     ======================= */

    public $campus = null;
    public $location = null;
    public $ap = null;

    /* =======================
     | VALIDATION
     ======================= */

    protected $rules = [
        'campus' => 'required|exists:campuses,id',
        'location' => 'required|exists:locations,id',
        'ap' => 'required|exists:assets,id',
    ];

    /* =======================
     | SUBMIT
     ======================= */

    public function submit()
    {
        $this->validate();

        AccessPointAssignment::create([
            'asset_id' => $this->ap,
            'location_id' => $this->location,
        ]);

        Asset::where('id', $this->ap)
            ->update(['status' => 'assigned']);

        return redirect('/ap-assignments')
            ->with('success', 'Access Point Assigned Successfully');
    }

    /* =======================
     | COMPUTED PROPERTIES
     ======================= */

    public function getCampusesProperty()
    {
        return Campus::orderBy('name')->get();
    }

    public function getLocationsProperty()
    {
        if (!$this->campus) {
            return collect();
        }

        return Location::where('campus_id', $this->campus)->get();
    }

    public function getApsProperty()
    {
        return Asset::where('status', 'available')
            ->where('asset_type', 'access_point')
            ->get();
    }

    /* =======================
     | HOOKS
     ======================= */

    public function updatedCampus()
    {
        $this->location = null;
    }

}; ?>


<div class="max-w-2xl mx-auto bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

    <h2 class="text-xl font-semibold text-gray-800 mb-2">
        Assign Access Point
    </h2>

    <p class="text-sm text-gray-500 mb-6">
        Select campus and location where the access point will be installed.
    </p>

    <form class="space-y-4" wire:submit.prevent="submit">

        <!-- CAMPUS -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Campus</label>

            <select wire:model.live="campus"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">Select Campus</option>

                @foreach ($this->campuses as $campus)
                    <option value="{{ $campus->id }}">
                        {{ $campus->name }}
                    </option>
                @endforeach

            </select>

            <x-input-error :messages="$errors->get('campus')" class="mt-2"/>
        </div>


        <!-- LOCATION -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">Location</label>

            <select wire:model="location"
                class="w-full border rounded-lg px-4 py-2"
                @disabled(!$campus)>

                <option value="">
                    {{ $campus ? 'Select Location' : 'Select Campus First' }}
                </option>

                @foreach ($this->locations as $loc)
                    <option value="{{ $loc->id }}">
                        {{ $loc->name }}
                    </option>
                @endforeach

            </select>

            <x-input-error :messages="$errors->get('location')" class="mt-2"/>
        </div>


        <!-- ACCESS POINT -->
        <div>
            <label class="block text-sm text-gray-600 mb-1">
                Access Point
            </label>

            <select wire:model="ap"
                class="w-full border rounded-lg px-4 py-2">

                <option value="">Select Access Point</option>

                @foreach ($this->aps as $ap)
                    <option value="{{ $ap->id }}">
                        {{ $ap->serial_number }} |
                        {{ $ap->brand }} |
                        {{ $ap->model }}
                    </option>
                @endforeach

            </select>

            <x-input-error :messages="$errors->get('ap')" class="mt-2"/>
        </div>


        <!-- SUBMIT -->
        <div class="flex justify-end pt-4">
            <button type="submit"
                class="px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">

                Assign Access Point

            </button>
        </div>

    </form>

</div>