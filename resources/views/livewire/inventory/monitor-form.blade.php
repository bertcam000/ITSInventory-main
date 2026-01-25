<?php

use App\Models\Asset;
use App\Models\Monitor;
use App\Models\SystemUnit;
use App\Models\MonitorSpec;
use Livewire\Volt\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

new class extends Component {

    public $serial_number;
    public $brand;
    public $model;
    public $size;
    public $status;
    // public $qrCode;

    protected $rules = [
        'serial_number' => 'required|string|max:255|unique:system_units,serial_number',
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'size' => 'required|string|max:255',
        'status' => 'required|string|in:available,assigned,repair,retired',
    ];

    public function submit()
    {
        $this->validate();

        // Logic to store the system unit in the database
        // For example:
        $su = Asset::create([
            'serial_number' => $this->serial_number,
            'asset_type' => 'monitor',
            'brand' => $this->brand,
            'model' => $this->model,
            'status' => $this->status,
        ]);

        MonitorSpec::create([
            'asset_id' => $su->id,
            'size' => $this->size,
        ]);

        $qrCode = QrCode::size(300)->generate($su->serial_number);
        
        $this->reset(['serial_number', 'brand', 'model', 'status']);
        
        redirect('qrcode')->with('success', 'System Unit added successfully!')->with('qrCode', $qrCode);
    }
    
}; ?>

<div @click.away="fmodal === ''" class="bg-white text-center p-5 space-y-4 rounded-lg w-[90%] lg:w-auto">
    <div class="text-xl">Add System Unit</div>
    <div class="flex items-center gap-5">
        <form wire:submit.prevent="submit" @click.away="fmodal = ''">
            @csrf
            <div class="grid lg:grid-cols-2 item gap-3 space-y-3">
                <div class="space-y-1 col-span-2">
                    <label for="serial_number" class="block text-sm font-medium text-start">Serial Number</label>
                    <input wire:model="serial_number" type="text" id="serial_number" name="serial_number" class="border border-gray-300 rounded-md p-2 w-full @error('serial_number') border-red-500 @enderror" />
                    <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <label for="brand" class="block text-sm font-medium text-start">Brand</label>
                    <input wire:model="brand" type="text" id="brand" name="brand" class="border border-gray-300 rounded-md p-2 w-full @error('brand') border-red-500 @enderror"  />
                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <label for="model" class="block text-sm font-medium text-start">Model</label>
                    <input wire:model="model" type="text" id="model" name="model" class="border border-gray-300 rounded-md p-2 w-full @error('model') border-red-500 @enderror"  />
                    <x-input-error :messages="$errors->get('model')" class="mt-2" />
                </div>
            </div>
            <div>
                <div class="space-y-1">
                    <label for="size" class="block mb-2.5 text-sm font-medium text-start">Size</label>
                    <textarea wire:model="size" id="size" rows="4" name="size" class="border border-gray-300 rounded-md border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body @error('size') border-red-500 @enderror" placeholder="Write size here..."></textarea>
                    <x-input-error :messages="$errors->get('size')" class="mt-2" />
                </div>
                <div class="space-y-1 mt-2">
                    <label for="status" class="block text-sm font-medium text-start">Status</label>
                    <select wire:model="status" id="countries" name="status" class="block w-full px-3 py-2 border border-gray-300 rounded-md p-2 @error('status') border-red-500 @enderror">
                        <option selected>Choose a status</option>
                        <option value="available">available</option>
                        <option value="assigned">assigned</option>
                        <option value="repair">repair</option>
                        <option value="retired">retired</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>
            <button type="submit" class="w-full bg-gray-300 mt-2 py-2 px-2 rounded-md">Create Item</button>
        </form>
    </div>
</div>
