<?php

namespace App\Providers;

use App\Models\Petani;
use App\Policies\PetaniPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Petani::class => PetaniPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-petani', function ($user) {
            return $user->isAdmin();
        });
    }
}
