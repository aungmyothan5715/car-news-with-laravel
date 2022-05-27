<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('post-create', function($user){
            return $user->id === 5;
            
        });//Post store For Admin
        Gate::define('post-update', function($user){
            return $user->id === 5;
        });//Post update for admin
        Gate::define('post-delete', function($user){
            return $user->id === 5;
        });

        Gate::define('comment-delete', function($user){
            return $user->id === auth()->user()->id;
        });// For comment delete if user-id == comment-user_id
    }
}
