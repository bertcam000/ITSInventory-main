<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>



<div class="p-4 flex-shrink-0">
    <a href="{{ route('profile') }}" wire:navigate>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primaryDark flex items-center justify-center flex-shrink-0">
                <span class="text-white font-semibold text-sm">IA</span>
            </div>
            <div x-show="sidebarOpen" class="flex-1 min-w-0">
                <p  class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">Admin Manager</p>
            </div>
        </div>
    </a>
    <a x-show="sidebarOpen" href="#" class="mt-3 flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
    {{-- <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
    </svg> --}}
        {{-- <x-responsive-nav-link :href="route('profile')" wire:navigate>
            {{ __('Profile') }}
        </x-responsive-nav-link> --}}

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
            <x-responsive-nav-link>
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </button>
    </a>
</div>