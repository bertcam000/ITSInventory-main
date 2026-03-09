<x-layouts.solo-layout>

<div class="min-h-screen py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white shadow-sm rounded-xl p-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-800">
                Edit PC Assignment
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Update the assigned assets and user.
            </p>
        </div>

        <form action="/assigned-pc/{{ $assignment->id }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Asset ID -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Asset ID</label>
                <input type="text" name="asset_id" value="{{ $assignment->asset_tag }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Department -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                <select name="department_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}"
                        {{ $assignment->department_id == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- System Unit -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">System Unit</label>
                <select name="system_unit_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="{{ $assignment->systemUnit->id }}" selected>{{ $assignment->systemUnit->serial_number }}</option>
                    @foreach($systemUnits as $unit)
                        <option value="{{ $unit->id }}">
                            {{ $unit->serial_number }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Monitor -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Monitor</label>
                <select name="monitor_id" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach($monitors as $monitor)
                        <option value="{{ $assignment->monitor->id }}" selected>{{ $assignment->monitor->serial_number }}</option>
                        <option value="{{ $monitor->id }}">
                            {{ $monitor->serial_number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Assigned To -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Assigned To</label>
                <input type="text" name="assigned_to" value="{{ $assignment->assigned_to }}" class="w-full border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="/assigned-pc" class="px-5 py-2 text-sm text-gray-600 border border-gray-200 rounded-lg hover:bg-gray-100 transition">Cancel</a>
                <button type="submit" class="px-5 py-2 text-sm text-white bg-primary transition rounded-lg">Update Assignment</button>
            </div>

        </form>

    </div>
</div>

</x-layouts.solo-layout>