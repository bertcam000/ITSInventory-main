<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::share(
        //     'campuses',
        //     cache()->remember('campuses', 3600, function () {
        //         return Campus::orderBy('name')->get();
        //     })
        // );

        Paginator::useTailwind();

        Gate::define('view-page', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
