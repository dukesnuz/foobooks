<?php

namespace App\Providers;

use App\Facades\Number;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class NumberServiceProvider extends ServiceProvider
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
        // this works
        // $this->app->bind('number', function () {
        // and this will work
        App::bind('number', function () {
            return new Number();
        });
    }
}
