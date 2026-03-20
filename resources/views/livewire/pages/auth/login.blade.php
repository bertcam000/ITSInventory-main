<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="space-y-5" wire:submit="login">

        <div class="form-input">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
            <input
                wire:model="form.username" id="username"
                type="username"
                placeholder="itstaff@company.com"
                class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
            />
            <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
        </div>

        <div class="form-input">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input
                wire:model="form.password" id="password"
                type="password"
                placeholder="••••••••"
                class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
            />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 accent-primary">
                <span class="text-gray-600">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-primary hover:text-primaryDark font-medium transition">Forgot password?</a>
        </div>

        <button
            type="submit"
            class="w-full btn-submit text-white py-3 rounded-lg font-semibold hover:shadow-lg">
            Login
        </button>
    </form>
    
</div>



