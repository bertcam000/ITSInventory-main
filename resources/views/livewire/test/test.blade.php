<?php

use App\Models\Asset;
use App\Models\MonitorSpec;
use Livewire\Volt\Component;
use App\Models\SystemUnitSpec;

new class extends Component {

    public string $asset_type = '';
    public string $serial_number = '';
    public string $brand = '';
    public string $model = '';

    public string $processor = '';
    public string $memory = '';
    public string $storage = '';
    public ?string $videocard = null;

    public string $size = '';

    public function rules()
    {
        return array_merge(
            [
                'asset_type' => 'required',
                'serial_number' => 'required_unless:asset_type,mouse,keyboard|unique:assets,serial_number',
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
            'user_id' => Auth::user()->id,
            'asset_type' => $this->asset_type === 'pc' ? 'system_unit' : $this->asset_type,
            'serial_number' => $this->serial_number,
            'brand' => $this->brand,
            'model' => $this->model,
            'created_by' => auth()->id(),
        ]);

        if ($this->asset_type === 'pc' || $this->asset_type === 'laptop') {
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
        return redirect('/inventory')->with('success', 'Asset created successfully!');
    }
    
}; ?>

<div @click.away="addAssetModalOpen = false" class="w-[550px] mx-auto p-6 bg-white rounded shadow space-y-6">

    <h2 class="text-xl font-semibold">Create Asset</h2>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block text-sm font-medium">Asset Type</label>
            <select wire:model.live="asset_type"
                    class="w-full rounded border-gray-300">
                <option value="">Select type</option>
                <option value="pc">System Unit</option>
                <option value="monitor">Monitor</option>
                <option value="laptop">Laptop</option>
                <option value="access_point">Access Point</option>
            </select>
            @error('asset_type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-medium">Serial Number</label>
                <input type="text" wire:model="serial_number" class="w-full rounded border-gray-300 @error('serial_number') border-red-500 @enderror" placeholder="ex. C8DTW2">
                @error('serial_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Brand</label>
                <input type="text" wire:model="brand" name="brand" class="w-full rounded border-gray-300 @error('brand') border-red-500 @enderror" placeholder="ex. Dell" autofocus autocomplete="brand">
            </div>

            <div>
                <label class="block text-sm font-medium">Model</label>
                <input type="text" wire:model="model" name="model" class="w-full rounded border-gray-300" placeholder="ex. OptiPlex 5080" autofocus autocomplete="model">
            </div>
        </div>

        @if ($asset_type === 'pc' || $asset_type === 'laptop')
            <div class="border rounded p-4 bg-gray-50 space-y-3">
                <h3 class="font-medium">PC Specifications</h3>

                <input type="text" wire:model="processor" name="processor" placeholder="Processor" class="w-full rounded border-gray-300" autofocus autocomplete="processor">
                <input type="text" wire:model="memory" name="memory" placeholder="Memory (e.g. 16GB)" class="w-full rounded border-gray-300" autofocus autocomplete="memory">
                <input type="text" wire:model="storage" name="storage" placeholder="Storage (e.g. 512GB SSD)" class="w-full rounded border-gray-300" autofocus autocomplete="storage">
                <input type="text" wire:model="videocard" name="videocard" placeholder="Video Card (optional)" class="w-full rounded border-gray-300" autofocus autocomplete="videocard">
            </div>
        @endif

        @if ($asset_type === 'monitor')
            <div class="border rounded p-4 bg-gray-50 space-y-3">
                <h3 class="font-medium">Monitor Specifications</h3>
                <input type="text" wire:model="size" name="size" placeholder="Size (e.g. 24 inch)" class="w-full rounded border-gray-300" autofocus autocomplete="size">
            </div>
        @endif

        <div class="pt-4 flex justify-end  gap-3">
            <div @click="addAssetModalOpen = false" class="px-4 border rounded border-gray-300 hover:bg-gray-100 flex justify-center items-center cursor-pointer">Cancel</div>
            <button type="submit" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary/90">Save Asset</button>
        </div>

    </form>
</div>
