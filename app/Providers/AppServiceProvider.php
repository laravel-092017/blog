<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //View::share('userName', 'guest');

        $isAuth = false;

        View::composer('*', function ($view) use ($isAuth) {
            if ($isAuth !== true) {
                $name =  'guest';
            } else {
                $name =  'Dima';
            }

            $view->with('userName', $name);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
