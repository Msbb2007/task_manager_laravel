<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('access-admin-panel', function (User $user) {
            return $user->role === User::ROLE_ADMIN;
        });

        Gate::define('manage-tasks', function (User $user) {
            return in_array($user->role, [User::ROLE_ADMIN, User::ROLE_EDITOR]);
        });
    }
}
