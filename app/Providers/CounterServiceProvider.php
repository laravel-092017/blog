<?php

namespace App\Providers;

use App\Includes\Classes\MyCounter;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->bind('AwesomeCounter', function ($app) {
            return new MyCounter();
        });*/

        $this->app->bind(
            'App\Includes\CounterInterface',
            'App\Includes\Classes\MyCounter'
        );
    }
}
