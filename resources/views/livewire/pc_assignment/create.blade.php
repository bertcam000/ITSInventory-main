<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div class="max-w-3xl mx-auto mt-10 bg-white border border-gray-200 rounded-xl p-6 shadow-sm">

    <!-- Header -->
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Assign PC</h2>
    <p class="text-sm text-gray-500 mb-6">Fill out the details below to assign a system unit and monitor to a department.</p>

    <!-- Form -->
    <form class="space-y-4">

        <!-- System Unit -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="system_unit">System Unit</label>
            <select
                id="system_unit"
                name="system_unit_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
                required
            >
                <option value="">Select System Unit</option>
                <option value="1">Dell OptiPlex 3080 (SN: D2WRT3)</option>
                <option value="2">HP ProDesk 400 G6 (SN: H4P2X8)</option>
            </select>
        </div>

        <!-- Monitor -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="monitor">Monitor</label>
            <select
                id="monitor"
                name="monitor_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
            >
                <option value="">Select Monitor</option>
                <option value="1">Dell 24” (SN: MON-29384)</option>
                <option value="2">LG 22” (SN: LG-2244)</option>
            </select>
        </div>

        <!-- Department -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="department">Department</label>
            <select
                id="department"
                name="department_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
                required
            >
                <option value="">Select Department</option>
                <option value="1">IT</option>
                <option value="2">Accounting</option>
                <option value="3">HR</option>
            </select>
        </div>

        <!-- Assigned To -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="assigned_to">Assigned To</label>
            <input
                type="text"
                id="assigned_to"
                name="assigned_to"
                placeholder="e.g. Juan Dela Cruz"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
                required
            >
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm text-gray-600 mb-1" for="status">Status</label>
            <select
                id="status"
                name="status"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-gray-200 focus:outline-none"
                required
            >
                <option value="assigned">Assigned</option>
                <option value="unassigned">Unassigned</option>
            </select>
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

