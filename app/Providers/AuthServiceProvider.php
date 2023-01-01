<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
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

        Gate::define('super-admin',function (User $user){
            return $user->access_level === 0;
        });

        Gate::define('charity-admin',function (User $user){
            return $user->access_level === 1;
        });

        Gate::define('employee-admin',function (User $user){
            return $user->access_level === 2;
        });
        //

        Gate::define('see-users',function (){
            return Gate::allows('charity-admin') or Gate::allows('super-admin');
        });
    }
}
