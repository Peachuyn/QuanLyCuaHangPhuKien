<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::define('isQuanLy', function ($user) {
            return $user->role == 0;
        });
        Gate::define('isKho', function ($user) {
            return $user->role == 1;
        });
        Gate::define('isBanHang', function ($user) {
            return $user->role == 2;
        });
        Gate::define('isNotBanHang', function ($user) {
            if ($user->role !== 2) {
                return true;
            }
            return false;
        });
        Gate::define('isNotQuanLy', function ($user) {
            if ($user->role !== 0) {
                return true;
            }
            return false;
        });
        Gate::define('isNotKho', function ($user) {
            if ($user->role !== 1) {
                return true;
            }
            return false;
        });
    }
}
