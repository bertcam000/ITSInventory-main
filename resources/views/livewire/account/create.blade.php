<?php

use Livewire\Volt\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    public $name = '';
    public $username = '';
    public $password = '';
    public $role = '';

    public function updatedName()
    {
        $this->generatePassword();
    }

    public function updatedUsername()
    {
        $this->generatePassword();
    }

    public function generatePassword()
    {
        $firstLetter = '';

        if (!empty(trim($this->name))) {
            $firstLetter = strtolower(substr(trim($this->name), 0, 1));
        }

        $this->password = $this->username . $firstLetter;
    }

    public function save()
    {
        $this->generatePassword();

        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:2',
            'role' => 'required|in:admin,staff',
        ]);

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        return redirect('/accounts')->with('success', 'User created successfully!');

        $this->reset(['name', 'username', 'password', 'role']);
    }
};
?>

<form wire:submit.prevent="save" class="space-y-5 px-6 py-6">
    <div>
        <label class="block text-sm text-gray-600 mb-1">Full Name</label>
        <input
            type="text"
            wire:model.live="name"
            class="w-full border rounded-lg border-gray-400/60 px-4 py-2"
            placeholder="e.g. Juan Dela Cruz"
        >
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">Username</label>
        <input
            type="text"
            wire:model.live="username"
            class="w-full border rounded-lg border-gray-400/60 px-4 py-2"
            placeholder="e.g. juan123"
        >
        <x-input-error :messages="$errors->get('username')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">Generated Password</label>
        <input
            type="text"
            wire:model="password"
            readonly
            class="w-full border rounded-lg border-gray-400/60 bg-gray-100 px-4 py-2 text-gray-700"
            placeholder="Password"
        >
        <p class="mt-1 text-xs text-gray-500">
            Format: username + first letter of full name
        </p>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div>
        <label class="block text-sm text-gray-600 mb-1">Role</label>
        <select
            wire:model="role"
            class="w-full border rounded-lg border-gray-400/60 px-4 py-2"
        >
            <option value="">Select role</option>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <button class="w-full rounded-2xl bg-primary py-3 text-white font-semibold">
        Create Account
    </button>
</form>