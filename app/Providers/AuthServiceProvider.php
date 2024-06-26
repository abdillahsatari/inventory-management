<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('isSuperadmin', function($user) {
            return $user->role_id == 1;
        });
        Gate::define('isAdmin', function($user) {
            return $user->role_id == 2;
        });
        Gate::define('isManager', function($user) {
            return $user->role_id == 3;
        });
        Gate::define('isStaff', function($user) {
            return $user->role_id == 4;
        });
        Gate::define('isCashier', function($user = null) {
            return true;
        });
    }
}
