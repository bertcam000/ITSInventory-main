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
    public $processor;
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
        'processor' => 'required|string|max:255',
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
            // 'memory' => $this->memory,
            // 'memory' => $this->memory,
            // 'storage' => $this->storage,
            // 'videocard' => $this->videocard,
            'status' => $this->status,
        ]);

        SystemUnitSpec::create([
            'asset_id' => $su->id,
            'processor' => $this->processor,
            'memory' => $this->memory,
            'storage' => $this->storage,
            'videocard' => $this->videocard,
        ]);

        $qrCode = QrCode::size(300)->generate($su->serial_number);
        
        $this->reset(['serial_number', 'brand', 'model', 'memory', 'storage', 'videocard', 'status']);
        
        redirect('qrcode')->with('success', 'System Unit added successfully!')->with('qrCode', $qrCode);
    }
    
}; ?>

{{-- <div @click.away="fmodal === ''" class="bg-white text-center p-5 space-y-4 rounded-lg w-[90%] lg:w-auto">
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
</div> --}}

<div  class="fixed inset-0 bg-black/30 flex items-center justify-center px-4">
    <div @click.away="fmodal = ''" class="w-full max-w-lg bg-white rounded-xl border border-gray-100 p-6">
        <h2 class="text-lg font-semibold text-gray-900">Add Asset</h2>
        <p class="text-sm text-gray-400 mt-1 mb-6">Enter hardware information below.</p>
        <form class="space-y-5" wire:submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input wire:model="serial_number" type="text" placeholder="Serial Number"class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('serial_number') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('serial_number')" class="mt-2" /> --}}
                <input wire:model="brand" type="text" placeholder="Brand" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('brand') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('brand')" class="mt-2" /> --}}
                <input wire:model="model" type="text" placeholder="Model" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('model') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('model')" class="mt-2" /> --}}
                <input wire:model="processor" type="text" placeholder="processor" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('processor') border-red-500 @enderror" />
                <input wire:model="memory" type="text" placeholder="Memory" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('memory') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('memory')" class="mt-2" /> --}}
                <input wire:model="storage" type="text" placeholder="Storage" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('storage') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('storage')" class="mt-2" /> --}}
                <input wire:model="videocard" type="text" placeholder="Video Card" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 sm:col-span-2 @error('videocard') border-red-500 @enderror" />
                {{-- <x-input-error :messages="$errors->get('videocard')" class="mt-2" /> --}}
                <select wire:model="status" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('status') border-red-500 @enderror">
                    <option value="">Status</option>
                    <option value="available">Available</option>
                    <option value="assigned">Assigned</option>
                    <option value="repair">Repair</option>
                    <option value="retired">Retired</option>
                </select>
                {{-- <x-input-error :messages="$errors->get('status')" class="mt-2" /> --}}
                <select wire:model="asset_type" class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 @error('asset_type') border-red-500 @enderror">
                    <option value="">Asset Type</option>
                    <option value="system_unit">System Unit</option>
                    <option value="laptop">Laptop</option>
                </select>
                {{-- <x-input-error :messages="$errors->get('asset_type')" class="mt-2" /> --}}
            </div>
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" class="px-4 py-2 text-sm rounded-md border border-gray-300 text-gray-600 hover:bg-gray-100 transition">Cancel</button>
                <button type="submit" class="px-4 py-2 text-sm rounded-md bg-gray-900 text-white hover:bg-gray-800 transition">Save</button>
            </div>
        </form>
    </div>
</div>

