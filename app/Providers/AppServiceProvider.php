<?php

namespace App\Providers;

use App\Includes\Classes\MyCounter;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        $isAuth = false;

        View::composer('*', function ($view) use ($isAuth) {
            if ($isAuth !== true) {
                $name =  'guest';
            } else {
                $name =  'Dima';
            }

            $view->with('userName', $name);
        });

        View::share('errors', []);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
