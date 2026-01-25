<?php

use App\Models\Asset;
use Livewire\Volt\Component;
use App\Models\SystemUnitSpec;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

new class extends Component {

    public $serial_number;
    public $brand;
    public $model;
    public $asset_type;
    public $memory;
    public $storage;
    public $videocard;
    public $status;
    // public $qrCode;

    protected $rules = [
        'serial_number' => 'required|string|max:255|unique:assets,serial_number',
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'asset_type' => 'required|string|in:system_unit,laptop',
        'memory' => 'required|string|max:255',
        'storage' => 'required|string|max:255',
        'videocard' => 'nullable|string|max:255',
        'status' => 'required|string|in:available,assigned,repair,retired',
    ];

    public function submit()
    {
        $this->validate();

        $su = Asset::create([
            'serial_number' => $this->serial_number,
            'asset_type' => $this->asset_type,
            'brand' => $this->brand,
            'model' => $this->model,
            'memory' => $this->memory,
            'storage' => $this->storage,
            'videocard' => $this->videocard,
            'status' => $this->status,
        ]);

        SystemUnitSpec::create([
            'asset_id' => $su->id,
            'memory' => $this->memory,
            'storage' => $this->storage,
            'videocard' => $this->videocard,
        ]);

        $qrCode = QrCode::size(300)->generate($su->serial_number);
        
        $this->reset(['serial_number', 'brand', 'model', 'memory', 'storage', 'videocard', 'status']);
        
        redirect('qrcode')->with('success', 'System Unit added successfully!')->with('qrCode', $qrCode);
    }
    
}; ?>

<div @click.away="fmodal === ''" class="bg-white text-center p-5 space-y-4 rounded-lg w-[90%] lg:w-auto">
    <div class="text-xl">Add System Unit</div>
    <div class="flex items-center gap-5">
        <form wire:submit.prevent="submit" @click.away="fmodal = ''">
            @csrf
            <div class="grid lg:grid-cols-2 item gap-2 space-y-2">
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
            <div class="grid lg:grid-cols-2 item gap-2 space-y-2 mt-2">
                <div class="space-y-1 col-span-2">
                    <label for="memory" class="block text-sm font-medium text-start">Memory</label>
                    <input wire:model="memory" type="text" id="memory" name="memory" class="border border-gray-300 rounded-md p-2 w-full @error('memory') border-red-500 @enderror" />
                    <x-input-error :messages="$errors->get('memory')" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <label for="storage" class="block text-sm font-medium text-start">Storage</label>
                    <input wire:model="storage" type="text" id="storage" name="storage" class="border border-gray-300 rounded-md p-2 w-full @error('storage') border-red-500 @enderror"  />
                    <x-input-error :messages="$errors->get('storage')" class="mt-2" />
                </div>
                <div class="space-y-1">
                    <label for="videocard" class="block text-sm font-medium text-start">Videocard</label>
                    <input wire:model="videocard" type="text" id="videocard" name="videocard" class="border border-gray-300 rounded-md p-2 w-full @error('videocard') border-red-500 @enderror"  />
                    <x-input-error :messages="$errors->get('videocard')" class="mt-2" />
                </div>
            </div>
            <div>
                {{-- <div class="space-y-1">
                    <label for="specs" class="block mb-2.5 text-sm font-medium text-start">Specs</label>
                    <textarea wire:model="specs" id="specs" rows="4" name="specs" class="border border-gray-300 rounded-md border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body @error('specs') border-red-500 @enderror" placeholder="Write specs here..."></textarea>
                    <x-input-error :messages="$errors->get('specs')" class="mt-2" />
                </div> --}}
                <div class="space-y-1 mt-2 grid grid-cols-2 items-center gap-2">
                    <div>
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
                    <div>
                        <label for="asset_type" class="block text-sm font-medium text-start">Asset Type</label>
                        <select wire:model="asset_type" id="asset_type" name="asset_type" class="block w-full px-3 py-2 border border-gray-300 rounded-md p-2 @error('asset_type') border-red-500 @enderror">
                            <option selected>Asset type</option>
                            <option value="system_unit">System Unit</option>
                            <option value="laptop">Laptop</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>
            </div>
            <button type="submit" class="w-full bg-gray-300 mt-2 py-2 px-2 rounded-md">Create Item</button>
        </form>
    </div>
</div>
