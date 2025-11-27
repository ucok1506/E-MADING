<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        Gate::define('admin-access', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('guru-access', function ($user) {
            return $user->isGuru() || $user->isAdmin();
        });

        Gate::define('manage-article', function ($user, $mading) {
            return $user->isAdmin() || $mading->user_id === $user->id;
        });
    }
}