<?php

namespace App\Providers;

use App\Models\Asset;
use App\Models\PcAssignment;
use App\Policies\AssetPolicy;
use App\Policies\PcAssingmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Asset::class => AssetPolicy::class,
        PcAssignment::class => PcAssingmentPolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
