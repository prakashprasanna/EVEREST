<?php

namespace App\Providers;
use App\destination;
use Illuminate\Support\ServiceProvider;

class Dynamicdestination extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('destination_array', destination::all()); // array which is used to store AJV Destination data
        });

    }

}
