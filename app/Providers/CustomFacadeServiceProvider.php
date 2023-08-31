<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CustomFacadeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('customfacade', function () {
            return new CustomFacade();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
