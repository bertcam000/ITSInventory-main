<?php

use Livewire\Volt\Component;

new class extends Component {

    public string $asset_type = '';
    public string $serial_number = '';
    public string $brand = '';
    public string $model = '';

    // PC specs
    public string $processor = '';
    public string $memory = '';
    public string $storage = '';
    public ?string $videocard = null;

    // Monitor specs
    public string $size = '';

    public function rules()
    {
        return array_merge(
            [
                'asset_type' => 'required|in:pc,monitor,laptop',
                'serial_number' => 'required|unique:assets,serial_number',
                'brand' => 'required',
                'model' => 'required',
            ],
            match ($this->asset_type) {
                'pc' => [
                    'processor' => 'required',
                    'memory' => 'required',
                    'storage' => 'required',
                ],
                'monitor' => [
                    'size' => 'required',
                ],
                default => []
            }
        );
    }

    public function updatedAssetType()
    {
        // reset fields when switching type
        $this->reset([
            'processor',
            'memory',
            'storage',
            'videocard',
            'size',
        ]);
    }

    public function save()
    {
        $this->validate();

        $asset = Asset::create([
            'asset_type' => $this->asset_type === 'pc' ? 'system_unit' : $this->asset_type,
            'serial_number' => $this->serial_number,
            'brand' => $this->brand,
            'model' => $this->model,
        ]);

        if ($this->asset_type === 'pc') {
            SystemUnitSpec::create([
                'asset_id' => $asset->id,
                'processor' => $this->processor,
                'memory' => $this->memory,
                'storage' => $this->storage,
                'videocard' => $this->videocard,
            ]);
        }

        if ($this->asset_type === 'monitor') {
            MonitorSpec::create([
                'asset_id' => $asset->id,
                'size' => $this->size,
            ]);
        }

        $this->reset();
        session()->flash('success', 'Asset created successfully!');
    }
    
}; ?>

<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow space-y-6">

    <h2 class="text-xl font-semibold">Create Asset</h2>

    @if (session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">

        <!-- Asset Type -->
        <div>
            <label class="block text-sm font-medium">Asset Type</label>
            <select wire:model.live="asset_type"
                    class="w-full rounded border-gray-300">
                <option value="">Select type</option>
                <option value="pc">PC</option>
                <option value="monitor">Monitor</option>
                <option value="laptop">Laptop</option>
            </select>
            @error('asset_type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Common Fields -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Serial Number</label>
                <input type="text" wire:model="serial_number" class="w-full rounded border-gray-300">
                @error('serial_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Brand</label>
                <input type="text" wire:model="brand" class="w-full rounded border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Model</label>
                <input type="text" wire:model="model" class="w-full rounded border-gray-300">
            </div>
        </div>

        <!-- PC Fields -->
        @if ($asset_type === 'pc')
            <div class="border rounded p-4 bg-gray-50 space-y-3">
                <h3 class="font-medium">PC Specifications</h3>

                <input type="text" wire:model="processor" placeholder="Processor" class="w-full rounded border-gray-300">
                <input type="text" wire:model="memory" placeholder="Memory (e.g. 16GB)" class="w-full rounded border-gray-300">
                <input type="text" wire:model="storage" placeholder="Storage (e.g. 512GB SSD)" class="w-full rounded border-gray-300">
                <input type="text" wire:model="videocard" placeholder="Video Card (optional)" class="w-full rounded border-gray-300">
            </div>
        @endif

        <!-- Monitor Fields -->
        @if ($asset_type === 'monitor')
            <div class="border rounded p-4 bg-gray-50 space-y-3">
                <h3 class="font-medium">Monitor Specifications</h3>

                <input type="text" wire:model="size" placeholder="Size (e.g. 24 inch)" class="w-full rounded border-gray-300">
            </div>
        @endif

        <!-- Submit -->
        <div class="pt-4">
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Save Asset
            </button>
        </div>

    </form>
</div>
