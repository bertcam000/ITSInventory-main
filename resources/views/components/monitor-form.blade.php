<form action="/createMonitor" method="POST" @click.away="fmodal = ''">
    @csrf
    <div class="grid grid-cols-2 gap-3 space-y-3">
        <div class="space-y-1">
            <label for="serial_number" class="block text-sm font-medium text-start">Serial Number</label>
            <input type="text" id="serial_number" name="serial_number" class="border border-gray-300 rounded-md p-2" required />
        </div>
        <div class="space-y-1">
            <label for="brand" class="block  text-sm font-medium text-start">Brand</label>
            <input type="text" id="brand" name="brand" class="border border-gray-300 rounded-md p-2" required />
        </div>
        
    </div>
    <div>
        <div class="space-y-1">
            <label for="specs" class="block mb-2.5 text-sm font-medium text-start">Specs</label>
            <textarea id="specs" rows="4" name="specs" class="border border-gray-300 rounded-md border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body" placeholder="Write specs here..."></textarea>
        </div>
        <div class="space-y-1 mt-2">
            <label for="status" class="block  text-sm font-medium text-start">Status</label>
            <select id="countries" name="status" class="block w-full px-3 py-2 border border-gray-300 rounded-md p-2">
                <option selected>Choose a status</option>
                <option value="available">available</option>
                <option value="assigned">assigned</option>
                <option value="repair">repair</option>
                <option value="retired">retired</option>
            </select>
        </div>
    </div>
    <button class="w-full bg-gray-300 mt-2 py-2 px-2 rounded-md">Create Item</button>
</form>