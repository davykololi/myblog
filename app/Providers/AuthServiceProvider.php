<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
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
        //
        /* define an admin user role */
        Gate::define('isAdmin',function(User $user){
            return $user->hasRole('admin');
        });

        /* define an editor user role */
        Gate::define('isEditor',function(User $user){
            return $user->hasRole('editor');
        });

        /* define an admin user role */
        Gate::define('isAuthor',function(User $user){
            return $user->hasRole('author');
        });

        /* define an admin user role */
        Gate::define('isVisitor',function(User $user){
            return $user->hasRole('visitor');
        });
    }
}
