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

        Gate::define('isBanHangAndCSKH', function ($user) {
            if ($user->role == 2 || $user->role == 3) {
                return true;
            }
            return false;
        });

        Gate::define('isKhoAndQuanLy', function ($user) {
            if ($user->role == 0 || $user->role == 1) {
                return true;
            }
            return false;
        });
        Gate::define('isKhoAndBanHang', function ($user) {
            if ($user->role == 1 || $user->role == 2) {
                return true;
            }
            return false;
        });
        Gate::define('isQuanLyAndBanHang', function ($user) {
            if ($user->role == 0 || $user->role == 2) {
                return true;
            }
            return false;
        });

        Gate::define('isCSKH', function ($user) {
            return $user->role == 3;
        });
    }
}
