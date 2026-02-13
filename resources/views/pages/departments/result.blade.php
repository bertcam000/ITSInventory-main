<x-layouts.its_layout>
    @if (session('success'))
        <x-notification :message="session('success')" type="success" />
    @endif
    <div x-data="{form: false, fmodal: ''}">
        {{-- <div>
            <x-tables.assigned_pc_table :pcs="$PcAssigned" />
        </div> --}}
        <div>
           @foreach ($department->pcAssignments as $assignment)
            <p>
                {{ $assignment->systemUnit->serial_number }}
            </p>
        @endforeach
        </div>
    </div>
</x-layouts.its_layout>