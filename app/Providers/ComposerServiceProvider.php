<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        view()->composer('*', 'App\Http\ViewComposers\BaseComposer');
        view()->composer('network_header', 'App\Http\ViewComposers\NetworkHeaderComposer');

        // Using Closure based composers...
        view()->composer('auth.login', function ($view) {
            
        });
    }

    /**
     * Register
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
