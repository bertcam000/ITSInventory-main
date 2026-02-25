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

    {{-- <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}

    {{--  --}}

    <form class="space-y-5" wire:submit="login">

        <div class="form-input">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
            <input
                wire:model="form.email" id="email"
                type="email"
                placeholder="itstaff@company.com"
                class="w-full px-4 py-3 rounded-lg focus:outline-none transition"
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
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



