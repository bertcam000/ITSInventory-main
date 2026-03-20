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
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </a>
    <a x-show="sidebarOpen" href="#" class="mt-3 flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900">
        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
                {{ __('Log Out') }}
        </button>
    </a>
</div>