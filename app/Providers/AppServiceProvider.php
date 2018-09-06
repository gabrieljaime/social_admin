<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        //Paginator::useBootstrapThree();
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale(config('app.locale'));
      

        \Laravel\Horizon\Horizon::auth(function ($request) {
         return true;
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
