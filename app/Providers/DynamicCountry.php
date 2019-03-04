<?php

namespace App\Providers;
use App\country;
use Illuminate\Support\ServiceProvider;

class DynamicCountry extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('country_array', country::all()); // array which is used to store country data
        });
    }

}
